<?php

namespace App\Observers;

use App\Models\ProductImage;
use Illuminate\Support\Facades\File;

class ProductImageObserver
{
    public function deleted(ProductImage $image)
    {
        $path = env('APP_STORAGE_PATH_PRODUCT_IMAGES', 'images/products');
        $path = storage_path('app/public' . '/' . $path . '/' . $image->path);
        File::delete($path);
        app('log')->info('deleting product image : ' . $path);
    }
}
