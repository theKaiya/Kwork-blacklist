<?php

namespace App\Http\Controllers;

use App\Person;

class PeopleController extends Controller
{
    public function show (Person $person)
    {
        $person = $person->withCount('reports')->first();

        return view('people.show', [
           'person' => $person,
        ]);
    }
}
