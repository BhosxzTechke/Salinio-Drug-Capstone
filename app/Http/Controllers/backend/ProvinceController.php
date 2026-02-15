<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            try {
                // Validation
                $request->validate([
                    'name' => 'required|string|max:255|unique:provinces,name',
                    'is_active' => 'required|boolean',
                ]);

                // Create Province
                Province::create([
                    'name' => $request->name,
                    'is_active' => $request->boolean('is_active'),
                ]);

                // Notification
                $notification = [
                    'message' => 'Province created successfully.',
                    'alert-type' => 'success',
                ];

                return redirect()->route('provinces.index')->with($notification);

            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withInput()->with([
                    'message' => 'Province already exists.',
                    'alert-type' => 'error',
                ]);

            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with([
                    'message' => 'Province already exists.',
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
            try {
                // Validation
                $request->validate([
                    'name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('provinces')->ignore($province->id),
                    ],
                    'is_active' => 'required|boolean',
                ]);


                // Update Province
                $province->update([
                    'name' => $request->name,
                    'is_active' => $request->boolean('is_active'),
                ]);

                // Notification
                $notification = [
                    'message' => 'Province updated successfully.',
                    'alert-type' => 'success',
                ];

                return redirect()->route('provinces.index')->with($notification);

            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withInput()->with([
                    'message' => 'Province name already exists.',
                    'alert-type' => 'error',
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with([
                    'message' => 'Unexpected error occurred.',
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

    public function destroy(Province $province)
    {
        $province->delete();

        return redirect()
            ->route('provinces.index')
            ->with('success', 'Province deleted successfully.');
    }
}
