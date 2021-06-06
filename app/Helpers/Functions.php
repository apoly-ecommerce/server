<?php

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

if (! function_exists('image_storage_dir'))
{
    function image_storage_dir()
    {
        return config('image.dir');
    }
}

if (! function_exists('image_cache_path'))
{
    function image_cache_path($path = Null)
    {
        $path = config('image.cache_dir') . '/' . $path;

        return Str::finish($path, '/');
    }
}


if (! function_exists('is_subscription_enabled'))
{
    function is_subscription_enabled()
    {
        return config('system.subscription.enabled');
    }
}

if (! function_exists('get_storage_file_url'))
{
    function get_storage_file_url($path = null, $size = 'small')
    {
        if (! $path) {
            return get_placeholder_img($size);
        }

        if($size == Null) {
            return url("storage/{$path}");
        }

        return url("storage/{$path}?p={$size}");
    }
}

if (! function_exists('get_placeholder_img'))
{
    function get_placeholder_img($size = 'small')
    {
        $size = config("image.sizes.{$size}");

        if ($size && is_array($size)) {
            return "https://placehold.it/{$size['w']}x{$size['h']}/eee?text=" . trans('app.no_img_available');
        }

        return url("images/placeholders/no_img.png");
    }
}

if (! function_exists('convert_to_slug_string'))
{
    function convert_to_slug_string($str, $salt = null, $separator = '-')
    {
        if ($salt) {
            return Str::slug($str, $separator) . $separator . Str::slug($salt, $separator);
        }

        return Str::slug($str, $separator);
    }
}
