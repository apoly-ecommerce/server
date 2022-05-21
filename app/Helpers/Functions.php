<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

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
            return "https://via.placeholder.com/{$size['w']}x{$size['h']}/";
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

if (! function_exists('get_sender_email'))
{
    function get_sender_email($shop = null)
    {
        if ($shop) {
            return config('shop_settings.default_sender_email_address') ?: config('mail.from.address');
        }

        return config('system_settings.default_sender_email_address') ??
            get_value_from(1, 'systems', 'default_sender_email_address') ??
            config('mail.from.name');
    }
}

if (! function_exists('get_sender_name'))
{
    function get_sender_name($shop = null)
    {
        if ($shop) {
            return config('shop_settings.default_sender_email_name') ?: config('mail.from.name');
        }

        return config('system_settings.default_sender_email_name') ??
            get_value_from(1, 'systems', 'default_email_sender_name') ??
            config('mail.from.name');
    }
}

if (! function_exists('get_value_from'))
{
    /**
     * Get value from a given table and id
     *
     * @param int $ids the primary keys
     * @param string $table
     * @param mixed $field
     *
     * @return mixed
     */
    function get_value_from($ids, $table, $field)
    {
        if (is_array($ids)) {
            $values = \DB::table($table)->select($field)->whereIn('id', $ids)->get()->toArray();

            if (! empty($values)) {
                $result = [];
                foreach ($values as $value) {
                    $result[] = $value->field;
                }
                return [];
            }
        }
        else {
            $value = \DB::table($table)->select($field)->where('id', $ids)->first();

            if (! empty($value) && isset($value->$field)) {
                return $value->$field;
            }
        }
    }
}

if (! function_exists('get_platform_title'))
{
    function get_platform_title()
    {
        return config('system_settings.name') ?: config('app.name');
    }
}

if (! function_exists('get_gravatar_url'))
{
    function get_gravatar_url($email, $size = 'small')
    {
        $email = md5(strtolower(trim($email)));

        $size = config("image.sizes.{$size}");

        return "https://www.gravatar.com/avatar/{$email}?s={$size['w']}&d=mm";
    }
}

if (! function_exists('get_qualified_model'))
{
    function get_qualified_model($class_name = '')
    {
        if ($class_name === 'user') {
            return 'App\\' . Str::singular(Str::studly($class_name));
        }
        return 'App\Models\\' . Str::singular(Str::studly($class_name));
    }
}


if (! function_exists('get_from_option_table'))
{
    function get_from_option_table($field, $default = null)
    {
        $record = \DB::table('options')->select('option_value')->where('option_name', $field)->first();

        if ($record) {
            $value = $record->option_value;

            return is_serialized($value) ? unserialize($value) : $value;
        }

        \DB::table('options')->insert([
            'option_name' => $field,
            'option_value' => is_array($default) ? serialize($default) : $default,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return $default;
    }
}


if (! function_exists('is_serialized'))
{
    /**
     * Check if the given value is_serialized or not
     */
    function is_serialized( $data ) {
        // if it isn't a string, it isn't serialized
        if (! is_string($data)) {
            return false;
        }

        $data = trim( $data );

        if ('N;' == $data) {
            return true;
        }

        if (! preg_match( '/^([adObis]):/', $data, $badions )) {
            return false;
        }

        switch ( $badions[1] ) {
            case 'a' :
            case 'O' :
            case 's' :
                if ( preg_match( "/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data ) )
                    return true;
                break;
            case 'b' :
            case 'i' :
            case 'd' :
                if ( preg_match( "/^{$badions[1]}:[0-9.E-]+;\$/", $data ) )
                    return true;
                break;
        }

        return false;
    }
}

if (! function_exists('get_percentage'))
{
    function get_percentage($old_num, $new_num)
    {
        return (($old_num - $new_num)*100) / $old_num;
    }
}
