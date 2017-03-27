<?php

namespace App\Helpers\Traits;

trait ApiHelper
{
    /**
     * @param $items
     * @return \Illuminate\Http\JsonResponse
     */
    public function response ($items)
    {
        $items = $items->paginate(1);

        return response()->json([
           'response' => $items,
        ]);
    }
}