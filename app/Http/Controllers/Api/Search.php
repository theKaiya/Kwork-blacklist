<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Helpers\Traits\ApiHelper;
use App\Report;
use App\Person;

class Search extends Controller
{
    use ApiHelper;

    /**
     * Search query
     *
     * @var mixed
     */
    protected $q;

    /**
     * Get data by section, e.g reports or customers.
     *
     * @var mixed|string
     */
    protected $section;

    /**
     * Customer id, for search.
     *
     * @var mixed
     */
    protected $person_id;

    /**
     * Search constructor.
     */
    public function __construct ()
    {
        $this->q = Input::get('query');

        $this->section = Input::get('section') ?? 'reports';

        $this->person_id = Input::get('person_id');
    }

    /**
     * Entry point
     */
    public function get ()
    {
        return $this->switchAct($this->section);
    }

    /**
     * @param $section
     * @return mixed
     */
    public function switchAct ($section)
    {
        if($section == 'reports')
            return $this->getReports();
        return $this->getCustomers();
    }

    /**
     * Get the reports.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReports ()
    {
        $q = Input::get('query');

        $reports = Report::where('is_activated', 1)
            ->orderBy('id', 'desc')
            ->with('person', 'user');

        if($q) {
            $reports = $this->query($reports);
        }

        if($this->person_id) {
            $reports = $reports->where('people_id', $this->person_id);
        }

        return $this->response($reports);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCustomers ()
    {
        $q = Input::get('query');

        $customers = Person::orderBy('id', 'desc');

        if($q) {
            $customers = $this->query($customers);
        }

        return $this->response($customers);
    }

    /**
     * Search.
     *
     * @param $item
     * @return mixed
     */
    public function query($item)
    {
        $q = Input::get('query');

        if($this->section == 'reports') {
            return $item->where('title', 'like', "%".$q."%")
                ->whereHas('person', function ($person) use ($q) {
                    $person->orWhere('username', 'like', "%".$q."%");
                });
        }else {
            return $item->where('username', 'like', "%".$q."%");
        }
    }
}
