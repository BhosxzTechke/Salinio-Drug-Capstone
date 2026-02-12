<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\City;
use Illuminate\Http\Request;

class BarangayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $barangays = Barangay::with('city.province')
            ->latest()
            ->paginate(10);

        return view('ShippingZone.barangay.AllBarangay', compact('barangays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $cities = City::where('is_active', 1)->get();
        return view('ShippingZone.barangay.CreateBarangay', compact('cities'));
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
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'extra_fee' => 'nullable|numeric',
            'is_active' => 'required|boolean',
        ]);

        Barangay::create($request->all());

        return redirect()
            ->route('barangays.index')
            ->with('success', 'Barangay created successfully.');
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


        public function edit(Barangay $barangay)
        {
            $cities = City::where('is_active', 1)->get();
            return view('ShippingZone.barangay.CreateBarangay', compact('barangay', 'cities'));
        }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Barangay $barangay)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'extra_fee' => 'nullable|numeric',
            'is_active' => 'required|boolean',
        ]);

        $barangay->update($request->all());

        return redirect()
            ->route('barangays.index')
            ->with('success', 'Barangay updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        
        public function destroy(Barangay $barangay)
        {
            $barangay->delete();

            return redirect()
                ->route('barangays.index')
                ->with('success', 'Barangay deleted successfully.');
        }


}
