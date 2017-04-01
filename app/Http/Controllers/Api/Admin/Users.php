<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Traits\ApiHelper;
use App\Http\Controllers\Controller;

use App\User;

class Users extends Controller
{
    use ApiHelper
    {
        ApiHelper::__construct as Constructor;
    }

    /**
     * Our user.
     *
     * @var
     */
    protected $item;

    public function __construct()
    {
        $this->Constructor();
    }

    /**
     * Get current user.
     *
     * @return mixed
     */
    public function boot ()
    {
        $this->item = User::find($this->id);

        if(! $this->item)
            return 'user not found.';

        return $this->switch();
    }

    /**
     * Toggle user privileges
     */
    public function admin ()
    {
        $this->item->update([
           'is_admin' => $this->item->is_admin ? 0 : 1,
        ]);

        return $this->json(['is_admin' => $this->item->is_admin]);
    }
}