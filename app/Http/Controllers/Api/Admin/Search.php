<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\Traits\ApiHelper;
use Illuminate\Http\Request;
use App\Report;
use App\Person;
use App\User;

class Search extends Controller
{
    use ApiHelper
    {
        ApiHelper::__construct as Constructor;
    }

    public function __construct()
    {
        $this->Constructor();
    }

    public function boot ()
    {
        $section = $this->section;

        if(method_exists($this, $this->section)) {
            return $this->$section();
        }
    }

    /**
     * Get users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function users ()
    {
        $users = User::query()
            ->orderBy('id', 'desc');

        if($this->request->has('admins')) {
            $users = $users->where('is_admin', 1);
        }

        if($this->request->has('users')) {
            $users = $users->where('is_admin', 0);
        }

        if($this->q) {
            $users = $users
                ->where('username', 'like', l($this->q))
                ->orWhere('email', 'like', l($this->q));
        }

        return $this->response($users, 15);
    }


    public function customers ()
    {
        $customers = Person::query()->orderBy('id', 'desc');

        if($this->q) {
            $customers = $customers->where('username', 'like', l($this->q));
        }

        return $this->response($customers, 15);
    }

    /**
     * Search the reviews.
     */
    public function reviews ()
    {
        $reviews = Report::query()
            ->with('person', 'user')
            ->orderBy('id', 'desc');

        $q = $this->request->get('query');

        if($this->request->has('is_accepted')) {
            $reviews = $reviews->where('is_accepted', 1);
        }

        if($this->request->has('is_not_accepted')) {
            $reviews = $reviews->where('is_accepted', 0);
        }

        if($q) {
            $reviews = $reviews
                ->where('title', 'like', l($q))
                ->orWhere('text', 'like', l($q))
                ->whereHas('person', function ($customer) use($q) {
                    $customer->orWhere('username', 'like', l($q));
                });
        }

        return $this->response($reviews, 15);
    }

}