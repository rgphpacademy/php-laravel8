<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class AuthController extends Controller
{

public function register(Request $request)
{
     $token = Str::random(40);
     $apiToken = hash('sha256', $token);

     $data = $request->all();

     array_push($data, $data["token"]=$apiToken);
     
     Storage::disk('local')->put('data.json', json_encode($data));

          $new_arr = [];
            foreach ($data as $key => $val) {
              $res = implode(" ", $data);
              
              array_push($new_arr, $res);
              for($i=0;$i < count($new_arr);$i++){
                unset($new_arr[1]);
              }
              foreach($new_arr as $k => $v){
                unset($new_arr[$k]);
                $new_arr["full_name"] = $v;
              }
             

            };

     return response()->json(['users'=>$new_arr, "token"=>$data["token"]]);
}
}