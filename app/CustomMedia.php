<?php

namespace App;

use Spatie\MediaLibrary\Models\Media;

/**
 * https://github.com/spatie/laravel-medialibrary/issues/1864
 * @package App
 */

class CustomMedia extends Media
{
    protected $table = 'media';
}
