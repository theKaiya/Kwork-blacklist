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
}
