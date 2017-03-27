<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    protected $appends = [
      'link'
    ];

    /**
     * User reviews to this person (comments)
     */
    public function comments ()
    {
        return $this->hasMany(PersonComment::class, 'people_id', 'id');
    }

    public function getLinkAttribute ()
    {
        return Route('people_show', $this->id);
    }

    public function reports ()
    {
        return $this->hasMany(Report::class, 'people_id', 'id');
    }
}
