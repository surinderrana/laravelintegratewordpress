<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Session;
class UserController extends Controller
{
	
	public function loginview(Request $request){
		$value = $request->session()->get('key');
		if(empty($value)){
			return view('login');
		}else{
			echo "already login";
			Session::flush(); 
		}
	}


	public function logindetails(Request $request){
		$name = $request->uname;
		$password = $request->psw;
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://localhost/tasks/wordpress/wp-json/myplugin/v1/author/?name='.$name.'&pass='."$password".'',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: wordpress_logged_in_3b7aac243a1fb0a0c11f82c3b0ae167d=user%7C1611059178%7C16tvPQiyB1dBVKA0KJntyfbL5poFwNWmTsWd1eQB12O%7Cb7030bdeef691ba755b1150c01cbd89e6d08fe3a0114ee77f9244a40478c4550'
		  ),
		));

		 $response = curl_exec($curl);

		curl_close($curl);
		if($response == '0'){
			return Redirect::back()->withErrors(['Credentials does not match']);
		}else{
			$result = json_decode($response);
			Session::put('key', $result);
			return redirect()->route('dashbord');
		}
		
	
	}

	/*  ----------------- view dashbord --------------*/
    public function viewdasbord(Request $request){
    	$value = $request->session()->get('key');
    	echo "<pre>";
    	print_r($value);

    }

}
