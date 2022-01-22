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



        //DB에 사용자 정보를 저장 한다
        //이미 이 사용자 정보가 DB에 저장 되어 있다면 , 
        //저장 할 필요가 없다.
        $user = User::firstOrCreate(
            ['email' => $user->getEmail()],
            [
                'password' =>  Hash::make(Str::random(24)),
                'name' => $user->getName()
            ]
            //create 로 배열의 칼럼값을 명시하려면,  model에 명시를 해줘야함
        );
        Auth::login($user);

        // 로그인했다고 세선에 저장





        return redirect('/');

        //원래 의도했던 사이트로 이동 , 없다면 default 로 




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
