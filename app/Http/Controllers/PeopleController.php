<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parser\ParsePerson;
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

    public function create_action (Request $request)
    {
        $this->validate($request, [
           'url' => 'required|max:255|url|https'
        ]);

        $url = $request->get('url');

        $person = Person::where('url', $url)->first();

        if(! $person)
            return $this->create_person($request);

        return redirect()->back()->with('success', 'Ой, кажется такой заказчик уже есть.');
    }

    public function create_person ($request)
    {
        $data = (new ParsePerson($request->url))->parse();

        if(!is_array($data))
            return redirect()->back()->with('error', "Error was occupied, contact support.");

        $person = Person::create($data);

        if($person) {
            return redirect()->back()->with('success', 'Заказчик успешно добавлен.');
        }

        return redirect()->back()->with('error', 'При создании заказчка произошла ошибка.');
    }

}
