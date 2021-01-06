<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
  private $tags;
  public function __construct(){
   $this->getterms();
  
  	/*$value = $request->session()->get('key');
		if(empty($value)){
			return view('login');
		} */
  }

   public function addpost(){
       return view('addpost');
   }
   

   public function postdetails(Request $request){
     $data = serialize($_POST);
     $curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://localhost/tasks/wordpress/wp-json/addpost/v1/posts?postdata='.$data.'',
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
		echo $response;
		if($response == 1){
			echo"post created succ";
		}else{
			echo"post creation failed";
		}
   }

   public function getallposts(){
   	    $alltags = $this->tags;
   		$alltagnames = array();
   		foreach($alltags as $key=>$tags){
   		 	$nkey = $tags->id;
           $alltagnames[$nkey] = $tags->name;
   		 }
   







		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://localhost/tasks/wordpress/wp-json/wp/v2/posts',
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
        $result = json_decode($response);
        $Allpostdata = array();
        $i=0; 
        foreach($result as $postdata){
            $Allpostdata[$i]['id']= $postdata->id;
        	$Allpostdata[$i]['title'] = $postdata->title->rendered;
        	$Allpostdata[$i]['content'] = strip_tags($postdata->content->rendered);
        	$taga = $postdata->tags;
        	$tagname = array();
        	foreach ($taga as $key => $value) {
        		if (array_key_exists($value,$alltagnames)){
                    $tagname[] = $alltagnames[$value];
        		}
        	}
     		$Allpostdata[$i]['tgas'] = implode(",", $tagname);


        	$i++;
        }
         return view('posts',compact('Allpostdata'));


      		/*$username = 'user';
			$password = '123456789';
			$rest_api_url = "http://localhost/tasks/wordpress/wp-json/wp/v2/posts";

			$data_string = json_encode([
			    'title'    => 'My title',
			    'content'  => 'My content',
			    'status'   => 'publish',
			]);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $rest_api_url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

			curl_setopt($ch, CURLOPT_HTTPHEADER, [
			    'Content-Type: application/json',
			    'Content-Length: ' . strlen($	),
			    'Authorization: Basic ' . base64_encode($username . ':' . $password),
			]);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			echo $result = curl_exec($ch);

			curl_close($ch);

			if ($result) {
			       echo"success";
			} else {
			       echo "not successs";
			}
*/
   }



   public function test(){

       echo 'test';



   }

   public function getterms(){
   		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://localhost/tasks/wordpress/wp-json/wp/v2/tags',
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
		//echo $response;
		$this->tags = json_decode($response);

      /*  echo "<pre>";
        print_r($result);*/
   }
/* ----------- update -------------------------------*/
public function updatepost(){
    $id = 25;
    $curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://localhost/tasks/wordpress/wp-json/getpost/v2/posts/'.$id.'',
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
	$result =  json_decode($response);
   return view('update',compact('result'));
}

/*    updatedata post */



public function update_post_data(){
	$username = 'user';
	$password = '123456789';
	$postid = 25;
	$rest_api_url = "http://localhost/tasks/wordpress/wp-json/wp/v2/posts/".$postid;
	$data_string = json_encode([
			    'title'    => 'My title',
			    'content'  => 'My content',
			    'status'   => 'publish',
			]);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_URL, $rest_api_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
	    'Content-Type: application/json',
		'Authorization: Basic ' . base64_encode($username . ':' . $password),
	]);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	echo $result = curl_exec($ch);

	curl_close($ch);

  }


/* ============update tags ============================*/

public function update_tags(){

//https://example.com/wp-json/wp/v2/tags
	$username = 'user';
	$password = '123456789';
	$postid = 10;
	$rest_api_url = "http://localhost/tasks/wordpress/wp-json/wp/v2/tags/".$postid;
	$data_string = json_encode([
			    'name'    => 'change'
			]);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_URL, $rest_api_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
	    'Content-Type: application/json',
		'Authorization: Basic ' . base64_encode($username . ':' . $password),
	]);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	echo $result = curl_exec($ch);

	curl_close($ch);

}












/*  ==================   Delete   the post -================*/

public function delete_post(){
	$username = 'user';
	$password = '123456789';
	$postid = 26;
	$rest_api_url = "http://localhost/tasks/wordpress/wp-json/wp/v2/posts/".$postid;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($ch, CURLOPT_URL, $rest_api_url);
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_HTTPHEADER, [
	    'Content-Type: application/json',
		'Authorization: Basic ' . base64_encode($username . ':' . $password),
	]);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	echo $result = curl_exec($ch);

	curl_close($ch);

  }


}
