<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportImage extends Model
{
    protected $fillable = [
        'user_id', 'report_id', 'path', 'image'
    ];

    public function getLinkAttribute ()
    {
        return asset($this->path.$this->image);
    }
}
