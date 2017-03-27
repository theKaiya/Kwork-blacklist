<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    /**
     * ReportController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show', 'create_action']);
    }

    /**
     * Show all reviews.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll ()
    {
        $reports = Report::orderBy('id', 'desc')
            ->with('user')
            ->paginate(10);

        return view('reviews.list', [
           'reports' => $reports,
        ]);
    }

    /**
     * Show current review.
     *
     * @param Report $report
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show (Report $report)
    {
        $report = $report->with('user', 'images', 'person')->first();

        return view('reviews.show', [
           'report' => $report,
        ]);
    }

    public function create ()
    {

    }

    public function create_action ()
    {

    }
}