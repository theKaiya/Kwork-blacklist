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
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show ($id)
    {
        $report = Report::with('user', 'images', 'person')->findOrFail($id);

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
