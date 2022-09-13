<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\School;

class Schoolcontroller extends Controller
{
     // get state 
     public function fetchState(Request $request)
     {
         $data['states'] = DB::table('school_datas')
                         ->where("district_name",$request->country_id)
                         ->get();
         return response()->json($data);
     }
 
     // use for school code 
     public function fetchCity(Request $request)
     {
         $data = DB::table('school_datas')
                           ->where("school_name",$request->state_id)
                           ->first();
                           
                           return response()->json($data);
     }
}
