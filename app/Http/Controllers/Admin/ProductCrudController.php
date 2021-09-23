<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\ProductImage;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;

    public $product_images_path;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->product_images_path = env('APP_STORAGE_PATH_PRODUCT_IMAGES', 'images/products');
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        // CRUD::column('description');
        CRUD::column('slug');
        CRUD::column('category')->type('relationship');
        CRUD::column('tags')->type('relationship');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);

        CRUD::field('name');
        CRUD::field('slug');
        CRUD::field('description')->type('ckeditor');
        CRUD::addField([
            'name' => 'images',
            'label' => 'Images',
            'type' => 'multipleImages',
            'upload' => true
        ]);
        CRUD::field('category')->type('relationship');
        CRUD::field('tags')->type('relationship');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(ProductRequest::class);
        if (request()->id)
        {
            $this->crud->getEntry(request()->id);
        }

        CRUD::field('name');
        CRUD::field('description')->type('ckeditor');
        CRUD::addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Will be automatically generated from your title, if left empty.',
        ]);
        CRUD::addField([
            'name' => 'previewImages',
            'label' => 'Images',
            'type' => 'previewImages',
            'images' => $this->crud->entry->images,
        ]);
        CRUD::addField([
            'name' => 'images',
            'label' => 'Add New Images',
            'type' => 'multipleImages',
            'upload' => true
        ]);
        CRUD::field('category')->type('relationship');
        CRUD::field('tags')->type('relationship');
    }

    private function handleImageUpload(Request $request)
    {
        $files_uploaded = [];
        if ($request->hasFile('images'))
        {
            foreach ($request->file('images') as $file)
            {
                $file_name = Str::random(16) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs($this->product_images_path, $file_name, ['disk' => 'public']);
                $files_uploaded[] = $path;
            }
        }
        return $files_uploaded;
    }

    private function handleImageDelete($files_uploaded)
    {
        foreach ($files_uploaded as $file)
        {
            $path = storage_path('app/public' . '/' . $file);
            if (File::exists($path))
            {
                File::delete($path);
            }
        }
    }

    public function store(Request $request)
    {
        //
        $files_uploaded = $this->handleImageUpload($request);

        //
        try {
            $response = $this->traitStore();
            if ($this->crud->entry)
            {
                foreach ($files_uploaded as $file)
                {
                    $this->crud->entry->images()->create([
                        'path' => str_replace($this->product_images_path . '/', '', $file)
                    ]);
                }
            }
        } catch (\Throwable $th) {
            $this->handleImageDelete($files_uploaded);
            throw $th;
        }
        //

        //
        return $response;
    }

    public function update(Request $request)
    {
        //
        $images = $this->crud->entry->images;
        $keep_images = $request->keepImages ?? [];
        $delete_images = $images->pluck('id')->diff($keep_images)->toArray();

        //
        $files_uploaded = $this->handleImageUpload($request);

        //
        try
        {
            $response = $this->traitUpdate();

            // delete images
            if (count($delete_images) > 0)
            {
                ProductImage::destroy($delete_images);
            }

            // add new images
            if ($this->crud->entry)
            {
                foreach ($files_uploaded as $file)
                {
                    $this->crud->entry->images()->create([
                        'path' => str_replace($this->product_images_path . '/', '', $file)
                    ]);
                }
            }
        } catch (\Throwable $th)
        {
            $this->handleImageDelete($files_uploaded);
            throw $th;
        }

        return $response;
    }
}
