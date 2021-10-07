<?php

use Illuminate\Support\Str;

if (!function_exists('product_images'))
{
    /**
     * Get the product images.
     *
     * @param  string $path
     * @return string
     */
    function product_images($path)
    {
        $upload_path = env('APP_STORAGE_PATH_PRODUCT_IMAGES', 'images/products');
        return asset('storage/' . $upload_path . '/' . $path);
    }
}

if (!function_exists('banner_image'))
{
    /**
     * Get the product banner.
     *
     * @param  string $path
     * @return string
     */
    function banner_image($path)
    {
        $upload_path = env('APP_STORAGE_PATH_BANNER_IMAGE', 'images/banners');
        return asset('storage/' . $upload_path . '/' . $path);
    }
}


if (!function_exists('generate_slug'))
{
    /**
     * Generate slug from string text
     *
     * @param  string $title
     * @return string
     */
    function generate_slug($title)
    {
        $title = $title . ' ' . time();
        return Str::slug($title, '-');
    }
}


if (!function_exists('generate_class'))
{
    /**
     * Generate class name for component with BEM Convention CSS
     *
     * @param  string $block
     * @return string
     */
    function generate_class($block)
    {
        $app_name = strtolower(config('app.name'));
        return $app_name . '__' . $block;
    }
}

if (!function_exists('money'))
{
    /**
     * money
     *
     * @param  float $value
     * @return string
     */
    function money($value)
    {
        $decimal = (int) env('MONEY_FORMAT_DECIMAL', 0);
        $hasil_rupiah = "Rp " . number_format($value, $decimal, ',' ,'.');
        return $hasil_rupiah;

    }
}
