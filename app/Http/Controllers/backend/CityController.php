<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            try {
                // Validation
            $request->validate([
                'province_id' => 'required|exists:provinces,id',
                'name' => 'required|string|max:255|unique:cities,name',
                'shipping_fee' => 'nullable|numeric',
                'delivery_days' => 'nullable|integer',
                'is_active' => 'required|boolean',
            ], [
                'name.unique' => 'City name already exists.', // custom message
            ]);

                City::create([
                    'province_id' => $request->province_id,
                    'name' => $request->name,
                    'shipping_fee' => $request->shipping_fee,
                    'delivery_days' => $request->delivery_days,
                    'is_active' => $request->boolean('is_active'),
                ]);

                // Notification
                $notification = [
                    'message' => 'City created successfully.',
                    'alert-type' => 'success',
                ];

                return redirect()->route('cities.index')->with($notification);

            } catch (QueryException $e) {
                return redirect()->back()->withInput()->with([
                    'message' => 'City already exists or database error.',
                    'alert-type' => 'error',
                ]);
            } 
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
            try {
                // Validation
            $request->validate([
                'province_id' => 'required|exists:provinces,id',
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('cities')->ignore($city->id),
                ],
                'shipping_fee' => 'nullable|numeric',
                'delivery_days' => 'nullable|integer',
                'is_active' => 'required|boolean',
            ], [
                'name.unique' => 'City name already exists.', // custom message
            ]);

            
                // Safe update
                $city->update([
                    'province_id' => $request->province_id,
                    'name' => $request->name,
                    'shipping_fee' => $request->shipping_fee,
                    'delivery_days' => $request->delivery_days,
                    'is_active' => $request->boolean('is_active'),
                ]);

                // Notification
                $notification = [
                    'message' => 'City updated successfully.',
                    'alert-type' => 'success',
                ];

                return redirect()->route('cities.index')->with($notification);

            } catch (QueryException $e) {
                return redirect()->back()->withInput()->with([
                    'message' => 'City name already exists or database error.',
                    'alert-type' => 'error',
                ]);
            } 
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
