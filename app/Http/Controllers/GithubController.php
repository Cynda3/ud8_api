<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GithubController extends Controller
{
    
	public function index(){
		return view('githubview')
	}

     public function getUser(Request $request)
    {
        $client = new Client(['base_uri' => 'https://api.github.com/']);  
        $response = $client->request('GET', 'users/' . $request->username); 
        $body = $response->getBody();
        $content =$body->getContents();
        
        $arr = json_decode($content,TRUE);
        $nombre = $arr['name'];
        $repositorios = $arr['public_repos'];
        $seguidores = $arr['followers'];


        // Seguidores
        $responseSeguidores = $client->request('GET', 'users/'.$request->username.'/followers');
        $bodySeguidores = $responseSeguidores->getBody();
        $contentSeguidores = $bodySeguidores->getContents();

        $arrSeguidores = json_decode($contentSeguidores,TRUE);

		$arrLoginSeguidores = array();

        for ($i=0; $i < count($arrSeguidores); $i++) { 
        	array_push($arrLoginSeguidores, $arrSeguidores[$i]['login']);
        }
        
        
    	//return $arrLoginSeguidores;
    	return view('github/mostrar')->with(['user'=>$nombre, 'repositorios' =>$repositorios, 'seguidores' => $seguidores, 'seguidoresLogin'=>$arrLoginSeguidores]); 
   
	}
}