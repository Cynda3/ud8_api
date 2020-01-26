<?php

namespace App\Http\Controllers;

use App\Image;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GithubController extends Controller
{
    
	public function index(){
		return view('githubform');
	}

     public function getUser(Request $request)
    {
        $client = new Client(['base_uri' => 'https://api.github.com/', 'auth' => ['cynda3', '0f8a3eeec8ecb86ef06f1f426101a14abb1893ef']]);  
        $response = $client->request('GET', 'users/' . $request->username); 
        $body = $response->getBody();
        $content =$body->getContents();
        
        $arr = json_decode($content,TRUE);
        $login = $arr['login'];
        $name = $arr['name'];
        $avatar = $arr['avatar_url'];
        $repositories = $arr['public_repos'];
        $followers = $arr['followers'];
        $following = $arr['following'];

        $userInfo = [
            'username' => $login,
            'name' => $name,
            'avatar' => $avatar,
            'repositories' => $repositories,
            'followers' => $followers,
            'following' => $following

        ];


        // Repositories
        $responseRepo = $client->request('GET', 'users/'.$request->username.'/repos');
        $bodyRepo = $responseRepo->getBody();
        $contentRepo = $bodyRepo->getContents();

        $arrRepos = json_decode($contentRepo,TRUE);

        for($i = 0; $i < count($arrRepos); $i++){
            $responseCollab = $client->request('GET', 'repos/'.$arrRepos[$i]['full_name'].'/contributors');
            $bodyCollab = $responseCollab->getBody();
            $contentCollab = $bodyCollab->getContents();
            
            $arrCollabs = json_decode($contentCollab,TRUE);


            $arrRepos[$i]['collaborators'] = $arrCollabs;
            
        }

        // Image
        if (isset($request->image)) {
            $image = $request->image;
            $image64 = base64_encode(file_get_contents($image));
            $curl = curl_init();

            $client_id = "ea6b6f70e1374d5";

            $token = "e12ef67319da5de1c22ed6f4b3d813f46f0f07d4";

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.imgur.com/3/image",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array("image" => $image64),
                CURLOPT_HTTPHEADER => array("Authorization: Client-ID ". $client_id)
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);


            if($err){
                echo "cURL Error #:" . $err;
            }else{
                $json = json_decode($response, true);


                $img = new Image;

                $img->url = $json['data']['link'];
                $img->repo = $request->reponame;

                $img->save();
            }
        }

        $imgs = Image::all();

    	
    	return view('githubform')->with(['user' => $userInfo, 'arrRepos' => $arrRepos, 'imgs' => $imgs]); 
   
	}
}