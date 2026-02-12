<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function index()
        {
            $cities = City::with('province')->latest()->paginate(10);
            return view('ShippingZone.City.AllCity', compact('cities'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function create()
        {
            $provinces = Province::where('is_active', 1)->get();
            return view('ShippingZone.City.CreateCity', compact('provinces'));
        }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function store(Request $request)
        {
            $request->validate([
                'province_id' => 'required|exists:provinces,id',
                'name' => 'required|string|max:255',
                'shipping_fee' => 'nullable|numeric',
                'delivery_days' => 'nullable|integer',
                'is_active' => 'required|boolean',
            ]);

            City::create($request->all());

            return redirect()
                ->route('cities.index')
                ->with('success', 'City created successfully.');
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
        $provinces = Province::where('is_active', 1)->get();
        return view('ShippingZone.City.EditCity', compact('city', 'provinces'));
    }
    /**
     * 
     * 
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


        public function update(Request $request, City $city)
        {
            $request->validate([
                'province_id' => 'required|exists:provinces,id',
                'name' => 'required|string|max:255',
                'shipping_fee' => 'nullable|numeric',
                'delivery_days' => 'nullable|integer',
                'is_active' => 'required|boolean',
            ]);

            $city->update($request->all());

            return redirect()
                ->route('cities.index')
                ->with('success', 'City updated successfully.');
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

        return redirect()
            ->route('cities.index')
            ->with('success', 'City deleted successfully.');
    }
}
