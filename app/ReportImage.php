<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportImage extends Model
{
    public function getLinkAttribute ()
    {
        return asset("/uploads/".$this->path.$this->image);
    }
}
