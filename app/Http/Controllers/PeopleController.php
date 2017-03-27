<?php

namespace App\Http\Controllers;

use App\Person;

class PeopleController extends Controller
{
    public function show ($id)
    {
        $person = Person::withCount('reports')->findOrFail($id);

        return view('people.show', [
           'person' => $person,
        ]);
    }

    /**
     * Return a create person view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create ()
    {
        return view('people.create');
    }

    public function create_action ()
    {
        //
    }

}
