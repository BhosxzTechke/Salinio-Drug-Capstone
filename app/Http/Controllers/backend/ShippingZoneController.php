<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingZoneController extends Controller
{
    //

        // --------- Provinces
        public function AllProvinces(){

        return view('ShippingZone.Provinces.AllProvinces');
        }


        public function CreateProvinces(){


        return view('ShippingZone.Provinces.CreateProvinces');
        }



        // --------- City
        public function AllCity(){

        return view('ShippingZone.City.AllCity');
        }


        public function CreateCity(){


        return view('ShippingZone.City.CreateCity');
        }



        
        // --------- Barangay
        public function AllBarangay(){

        return view('ShippingZone.Barangay.AllBarangay');
        }


        public function CreateBarangay(){


        return view('ShippingZone.Barangay.CreateBarangay');
        }


        
        

}
