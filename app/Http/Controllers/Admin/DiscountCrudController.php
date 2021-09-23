<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DiscountRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DiscountCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DiscountCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Discount::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/discount');
        CRUD::setEntityNameStrings('discount', 'discounts');
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
        CRUD::addColumn([
            'name' => 'discount',
            'label' => 'Discount',
            'suffix' => '%',
            'type' => 'number',
            'decimals' => 2,
        ]);
        CRUD::column('start_date');
        CRUD::column('end_date');

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
        CRUD::setValidation(DiscountRequest::class);

        CRUD::field('name');
        CRUD::addField([
            'name' => 'discount',
            'label' => 'Discount',
            'suffix' => '%',
            'type' => 'number',
            'decimals' => 2,
            'default' => 0.00,
            'attributes' => [
                'step' => 'any',
                'min' => 0.00,
                'max' => 100.00
            ],
        ]);
        CRUD::addField([
            'name' => 'start_date',
            'label' => 'start Date',
            'type' => 'datetime_picker',
            'datetime_picker_options' => [
                'format' => 'DD/MM/YYYY HH:mm'
            ]
        ]);
        CRUD::addField([
            'name' => 'end_date',
            'label' => 'end Date',
            'type' => 'datetime_picker',
            'datetime_picker_options' => [
                'format' => 'DD/MM/YYYY HH:mm'
            ]
        ]);

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
        $this->setupCreateOperation();
    }
}
