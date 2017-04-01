<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
      'people_id', 'user_id', 'text', 'title', 'is_accepted'
    ];

    protected $appends = [
      'short_desc', 'medium_desc', 'link', 'author_username', 'author_picture', 'person_username'
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
    public function getShortDescAttribute ()
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

    /**
     * Get a medium text.
     *
     * @return string
     */
    public function getMediumDescAttribute ()
    {
        return str_limit($this->text, 300);
    }

    public function getAuthorUsernameAttribute ()
    {
        if($this->relationLoaded('user')) {
            return $this->user ? $this->user->username : "Пользователь был удален";
        }
    }

    public function getAuthorPictureAttribute ()
    {
        if($this->relationLoaded('user')) {
            return $this->user ? $this->user->avatar : deletedPicture();
        }
    }

    public function getPersonUsernameAttribute ()
    {
        if($this->relationLoaded('person')) {
            return $this->person ? $this->person->username : 'Kwork';
        }
    }
}
