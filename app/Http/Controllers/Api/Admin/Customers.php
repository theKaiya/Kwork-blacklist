<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Traits\ApiHelper;
use App\Http\Controllers\Controller;

use App\Person;

class Customers extends Controller
{
    use ApiHelper
    {
        ApiHelper::__construct as Constructor;
    }

    /**
     * Our customer.
     *
     * @var
     */
    protected $item;

    public function __construct()
    {
        $this->Constructor();
    }

    public function boot ()
    {
        $this->item = Person::find($this->id);

        if(! $this->item)
            return 'Not found.';

        return $this->switch();
    }


}