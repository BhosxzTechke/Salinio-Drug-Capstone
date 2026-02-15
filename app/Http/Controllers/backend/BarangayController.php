<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\City;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

        return view('ShippingZone.Barangay.AllBarangay', compact('barangays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $cities = City::where('is_active', 1)->get();
        return view('ShippingZone.Barangay.CreateBarangay', compact('cities'));
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
            'city_id' => 'required|exists:cities,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('barangays')->where(fn ($query) => $query->where('city_id', $request->city_id)),
            ],
            'extra_fee' => 'nullable|numeric',
            'is_active' => 'required|boolean',
        ], [
            'name.unique' => 'Barangay name already exists in this city.',
        ]);

        // Safe creation
        Barangay::create([
            'city_id' => $request->city_id,
            'name' => $request->name,
            'extra_fee' => $request->extra_fee,
            'is_active' => $request->boolean('is_active'),
        ]);

        // Notification
        $notification = [
            'message' => 'Barangay created successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('barangays.index')->with($notification);

    } catch (QueryException $e) {
        return redirect()->back()->withInput()->with([
            'message' => 'Database error occurred.',
            'alert-type' => 'error',
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with([
            'message' => 'Unexpected error occurred. Please try again.',
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
    try {
        // Validation
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('barangays')
                    ->where(fn ($query) => $query->where('city_id', $request->city_id))
                    ->ignore($barangay->id),
            ],
            'extra_fee' => 'nullable|numeric',
            'is_active' => 'required|boolean',
        ], [
            'name.unique' => 'Barangay name already exists in this city.',
        ]);

        // Safe update
        $barangay->update([
            'city_id' => $request->city_id,
            'name' => $request->name,
            'extra_fee' => $request->extra_fee,
            'is_active' => $request->boolean('is_active'),
        ]);

        // Notification
        $notification = [
            'message' => 'Barangay updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('barangays.index')->with($notification);

    } catch (QueryException $e) {
        return redirect()->back()->withInput()->with([
            'message' => 'Database error occurred.',
            'alert-type' => 'error',
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with([
            'message' => 'Unexpected error occurred. Please try again.',
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

        
        public function destroy(Barangay $barangay)
        {
            $barangay->delete();

            return redirect()
                ->route('barangays.index')
                ->with('success', 'Barangay deleted successfully.');
        }


}
