<?php

use Illuminate\Support\Str;

if (!function_exists('product_images'))
{
    function product_images($path)
    {
        $upload_path = env('APP_STORAGE_PATH_PRODUCT_IMAGES', 'images/products');
        return asset('storage/' . $upload_path . '/' . $path);
    }
}


if (!function_exists('generate_slug'))
{
    function generate_slug($title)
    {
        $title = $title . ' ' . time();
        return Str::slug($title, '-');
    }
}
