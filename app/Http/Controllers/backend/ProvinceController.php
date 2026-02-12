<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
            public function index()
            {


                $provinces = Province::latest()->paginate(10);
                return view('ShippingZone.Provinces.AllProvinces', compact('provinces'));

            }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
            public function create()
            {
                return view('ShippingZone.Provinces.CreateProvinces');
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
                    'name' => 'required|string|max:255',
                    'is_active' => 'required|boolean',
                ]);

                Province::create([
                    'name' => $request->name,
                    'is_active' => $request->is_active,
                ]);

                return redirect()
                    ->route('provinces.index')
                    ->with('success', 'Province created successfully.');
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

        public function edit(Province $province)
        {

            return view('ShippingZone.Provinces.EditProvinces', compact('province'));
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


        public function update(Request $request, Province $province)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'is_active' => 'required|boolean',
            ]);

            $province->update([
                'name' => $request->name,
                'is_active' => $request->is_active,
            ]);

            return redirect()
                ->route('provinces.index')
                ->with('success', 'Province updated successfully.');
        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Province $province)
    {
        $province->delete();

        return redirect()
            ->route('provinces.index')
            ->with('success', 'Province deleted successfully.');
    }
}
