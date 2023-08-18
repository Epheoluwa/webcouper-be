<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        return view('resturants');
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
    // public function fetchrecipes()
    // {
    //     $curl = curl_init();
    //     $recipe_Key = env('EDAMANN_APIKEY');

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => "https://edamam-food-and-grocery-database.p.rapidapi.com/api/food-database/v2/parser?ingr=rice",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => [
    //             "X-RapidAPI-Host: edamam-food-and-grocery-database.p.rapidapi.com",
    //             "X-RapidAPI-Key: $recipe_Key",
    //         ],
    //     ]);

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);
    //     $main_response = json_decode($response);
    //     if ($err) {
    //         echo "cURL Error #:" . $err;
    //     } else {
    //         print_r( $main_response->hints);
    //         echo gettype($main_response);
    //     }
    // }
}
