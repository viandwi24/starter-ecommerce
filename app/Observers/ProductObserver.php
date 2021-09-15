<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductObserver
{
    public function deleted(Product $product)
    {
        if ($product->images)
        {
            foreach ($product->images as $image)
            {
                $path = env('APP_STORAGE_PATH_PRODUCT_IMAGES', 'images/products');
                $path = storage_path('app/public' . '/' . $path . '/' . $image->path);
                File::delete($path);
                app('log')->info('deleting product image : ' . $path);
            }
        }
    }
}
