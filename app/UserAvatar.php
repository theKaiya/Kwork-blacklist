<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAvatar extends Model
{
    /**
     * Return a image url.
     */
    public function url ()
    {
        return $this->path.$this->image;
    }
}
