<?php

namespace App\Helpers\Traits;

trait ApiHelper
{
    protected $id;

    protected $method;

    protected $section;

    protected $q;

    protected $request;

    public function __construct()
    {
        $this->request = request();

        $this->id = request()->get('id');

        $this->method = request()->get('method');

        $this->section = request()->get('section');

        $this->q = request()->get('query');
    }

    /**
     * @param $items
     * @param $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function response ($items, $limit = 12)
    {
        $items = $items->paginate($limit);

        return response()->json([
           'response' => $items,
        ]);
    }

    public function remove ($item)
    {
        $item->forceDelete();

        return response('Done!', 200);
    }

    public function switch ()
    {
        $method = $this->method;

        if(method_exists($this, $method)) {
            return $this->$method($this->item);
        }
    }

    public function json ($data)
    {
        return response()->json($data);
    }

}