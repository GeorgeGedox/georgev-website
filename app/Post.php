<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Parsedown;

class Post extends Model
{
    protected $fillable = ['title', 'body'];

    public function getHtmlBodyAttribute()
    {
        return new HtmlString(app(Parsedown::class)->setSafeMode(true)->text($this->body));
    }

    public function getDateAttribute(){
        return date('d M Y', strtotime($this->created_at));
    }
}
