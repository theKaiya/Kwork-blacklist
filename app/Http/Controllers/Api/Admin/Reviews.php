<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Traits\ApiHelper;
use App\Http\Controllers\Controller;

use App\Report;

class Reviews extends Controller
{
    use ApiHelper
    {
        ApiHelper::__construct as Constructor;
    }

    protected $item;

    public function __construct()
    {
        $this->Constructor();
    }

    public function boot ()
    {
        $this->item = Report::find($this->id);

        if(! $this->item)
            return 'Not found.';

        return $this->switch();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function accept ()
    {
        $review = $this->item;

        $review->update([
            'is_accepted' => $review->is_accepted ? 0 : 1,
        ]);

        return $this->json(['is_accepted' => $review->is_accepted]);
    }

}