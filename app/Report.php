<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $appends = [
      'short_text', 'link'
    ];

    public function person ()
    {
        return $this->hasOne(Person::class, 'id', 'people_id');
    }

    /*
     * Report images, e.g proof
     */
    public function images ()
    {
        return $this->hasMany(ReportImage::class, 'report_id', 'id');
    }

    /*
     * Author of the review.
     */
    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return string
     */
    public function getShortTextAttribute ()
    {
        return str_limit($this->text, 50);
    }

    /**
     * return string
     */
    public function getLinkAttribute ()
    {
        return route('review_show', $this->id);
    }
}
