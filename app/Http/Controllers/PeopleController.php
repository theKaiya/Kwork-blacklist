<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

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
