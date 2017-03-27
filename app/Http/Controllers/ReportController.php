<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\ReportImage;
use Carbon\Carbon;
use App\Person;
use App\Report;
use Validator;
use Image;

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

    /**
     * Return a create person view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_creating_page ()
    {
        return view('reviews.create', [
            'persons' => Person::all(),
        ]);
    }

    public function create_action (Request $request)
    {
        $this->validator($request);

        $report = $this->create($request);

        if($report) {
            return redirect()->back()->with('success', 'После модерации отзыв будет доступе на сайте.');
        }

        return redirect()->back()->with('error', 'Что-то пошло не так. Свяжитесь с администрацией.');
    }

    /**
     * @param Request $request
     */
    public function validator (Request $request)
    {
        return $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'images.*' => 'image|mimes:jpg,png',
            'people' => 'required|integer',
        ]);
    }


    /**
     * Create a new report instance.
     *
     * @param Request $request
     * @return mixed
     */
    public function create (Request $request)
    {
        $report = Report::create([
           'user_id' => auth()->user()->id,
           'people_id' => $request->get('people'),
           'title' => $request->get('title'),
           'text' => $request-> get('description'),
           'is_activated' => 0,
        ]);

        if($request->hasFile('images'))
            $this->uploadImages($report);

        return $report;
    }

    /**
     * @param Report $report
     */
    public function uploadImages (Report $report)
    {
        $files = Input::file('images');

        $images = [];

        foreach($files as $file)
        {
            $image = str_random(30).'.jpg';

            $path = 'uploads/reports/';

            Image::make($file)->save(public_path($path.$image));

            $images[] = [
              'user_id' => $report->user_id,
              'report_id' => $report->id,
              'path' => $path,
              'image' => $image,
            ];
        }

        ReportImage::insert($images);
    }
}
