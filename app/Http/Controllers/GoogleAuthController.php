<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class GoogleAuthController extends Controller
{



    public function redirect()
    {



        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {




        // $user = Socialite::driver('google')->stateless()->user();

        // $finduser = User::where('email', $user->email)->first();

        // if ($finduser) {

        //     Auth::login($finduser);

        //     return redirect('/home');
        // } else {
        //     $newUser = User::create([
        //         'name' => $user->name,
        //         'email' => $user->email,

        //         'password' => bcrypt('123123123')
        //     ]);

        //     Auth::login($newUser);

        //     return redirect('/home');
        // }





        // $googleUser = Socialite::driver('google')->stateless()->user();
        // $existUser = User::where('email', $googleUser->email)->first();


        // if ($existUser) {
        //     Auth::loginUsingId($existUser->id);
        // } else {
        //     $user = new User;
        //     $user->name = $googleUser->name;
        //     $user->email = $googleUser->email;
        //     $user->google_id = $googleUser->id;
        //     $user->password
        //         = Hash::make(Str::random(24));
        //     $user->save();
        //     Auth::loginUsingId($user->id);
        // }
        // return redirect()->to('/home');


        // dd();
        $user = Socialite::driver('google')->stateless()->user();


        $user = User::firstOrCreate(
            ['email' => $user->getEmail()],
            [
                'password' =>  Hash::make(Str::random(24)),
                'name' => $user->getName()
            ]

        );


        Auth::login($user);





        return redirect('/');





        // $user = Socialite::driver('google')->user();
        // $user = User::firstOrCreate([
        //     'email' => $user->getEmail()
        // ], [
        //     'name' => $user->getName(),
        //     'password' => Hash::make(Str::random(24))
        // ]);
        // Auth::login($user, true);



        // return redirect('/');
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
}
