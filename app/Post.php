<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Parsedown;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'draft'];
    protected $casts = [
        'draft' => 'accepted'
    ];

    public function getHtmlBodyAttribute()
    {
        return new HtmlString(app(Parsedown::class)->setSafeMode(true)->text($this->body));
    }

    public function getDateAttribute()
    {
        return date('d M Y', strtotime($this->created_at));
    }

    /**
     * Auto-generate new slug on title update
     * @param $value
     * @throws \Exception
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value . '-' . random_int(100, 100000));
    }
}
