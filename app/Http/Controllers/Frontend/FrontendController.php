<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\Restuarant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class FrontendController extends Controller
{
    public function fetchusers()
    {
        $data = User::all();
        return new JsonResponse([
            'status' => 201,
            'user' => $data
        ], 201);
    }

    public function fetchSingleUser($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return new JsonResponse([
            'status' => 201,
            'user' => $user
        ], 201);
    }

    public function fetchAuthenticatedUsers()
    {
    }

    public function recipe()
    {
        $searchparams = [];
        return view('recipe', compact('searchparams'));
    }

    public function resturants()
    {
        $restaurants = [];
        return view('resturants', compact('restaurants'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function allusers()
    {
        $users = User::all();
        return view('allusers', compact('users'));
    }


    public function fetchrecipes(Request $request)
    {
        $query = $request->input('search');
        $validator = Validator::make($request->all(), [
            'search' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }
        $data = [
            'queryParams' => $query,
            'name' => Auth::user()->username
        ];
        Recipe::create($data);
        $curl = curl_init();
        $recipe_Key = env('EDAMANN_APIKEY');

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://edamam-food-and-grocery-database.p.rapidapi.com/api/food-database/v2/parser?ingr=$query",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: edamam-food-and-grocery-database.p.rapidapi.com",
                "X-RapidAPI-Key: $recipe_Key",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $main_response = json_decode($response);
        $searchparams = $main_response->hints;
        if ($err) {
            return back()->with('error', $err);
        } else {
            return view('recipe', compact('searchparams', 'query'));
        }
    }

    public function searchResturants(Request $request)
    {
        $apiKey = getenv('GOOGLE_PLACES_API_KEY');
        $query = $request->input('search');
        $validator = Validator::make($request->all(), [
            'search' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }
        $data = [
            'queryParams' => $query,
            'name' => Auth::user()->username
        ];
        Restuarant::create($data);
        
        $client = new Client();
        try {
            $response = $client->get("https://maps.googleapis.com/maps/api/place/textsearch/json", [
                'query' => [
                    'key' => $apiKey,
                    'query' => $query,
                ]
            ]);
         
            $restaurants = json_decode($response->getBody())->results;

        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
        
        return view('resturants', compact('restaurants'));
    }

}
