<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = City::query();

        if (request('search')) {
            $query->where('name', 'like', "%{$request->search}%")
            ->orWhere('country_id', 'like', "%{$request->search}%");
        }

        $cities = $query->paginate(10);

        return view('dashboard.city.index', [
            'cities' => $cities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('dashboard.city.create', [
            'countries' => $countries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        City::insert($data);
        return redirect(route('cities.index'))->with('success', 'City saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::all();
        return view('dashboard.city.edit', [
            'city' => $city,
            'countries' => $countries
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $data = $this->validateData($request);
        $city->update($data);
        return redirect(route('cities.index'))->with('success', 'City saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect(route('cities.index'))->with('success', 'City deleted successful');
    }

    public function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string',
            'country_id' => 'required',
            'state_id' => 'required'
        ]);
    }
}
