<?php

namespace App\Http\Controllers;


use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    // public function register(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $user = User::create([
    //         'name' => $validatedData['name'],
    //         'email' => $validatedData['email'],
    //         'password' => Hash::make($validatedData['password']),
    //     ]);

    //     $token = $user->createToken('auth_token')->plainTextToken;
    //     $cookie = cookie('ccc', $token, 60 * 24);
    //     // return redirect()->route('home')->withCookie($cookie);
    //     return response([
    //         'message' => 'Success'
    //     ])->withCookie($cookie);
    // }
    // public function login(Request $request)
    // {
    //     if (!Auth::attempt($request->only('email', 'password'))) {
    //         return response([
    //             'message' => 'Invalid '
    //         ], Response::HTTP_UNAUTHORIZED);
    //     }

    //     // $user = Auth::user();
    //     $user = User::where('email', $request['email'])->firstOrFail();
    //     $token = $user->createToken('token')->plainTextToken;

    //     $cookie = cookie('jwt', $token, 60 * 24);

    //     $this->createNewToken($token);
    //     return redirect()->route('home')->withCookie($cookie);
    // }


    // public function logout(Request $request)
    // {
    //     // Auth::guard('web')->logout();
    //     // $this->guard()->logout();

    //     // auth()->logout();

    //     // return response([
    //     //     'message' => 'Success'
    //     // ]);


    //     // // Auth::logout();
    //     // $this->app->get('auth')->forgetGuards();


    //     auth()->logout();

    //     return Redirect::to('/', ['Accept' => 'application/json']);
    // }
    // // 로그인 테스트 해보다 계속 home으로 redirect 시키면 쿠키값이 남아있어서 그런거임. 쿠키값 삭제하고 다시 로그인 테스트해
    // protected function createNewToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         // 'expires_in' => auth()->factory()->getTTL() * 60,
    //         'user' => auth()->user()
    //     ]);
    // }

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'logout', 'user']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email|max:255',
        //     'password' => 'required|string|min:8|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'messages' => $validator->messages()
        //     ], 200);
        // }

        // if (!$token = Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }


        // return $this->respondWithToken($token);

        // // dd(Auth::user());



        // $request->header('Authorization', "Bearer " . $request->bearerToken());

        // return redirect('/')->headers->set('Authorization', 'Bearer ' . $request->cookie($jwt_token));
        // return redirect();
        // return response()->json([
        //     'success' => true,
        //     'token' => $jwt_token,
        // ]);

        //             mmmmmmmmmmmm
        //         $input = $request->only('email', 'password');
        //         $jwt_token = null;

        //         if (!$jwt_token = JWTAuth::attempt($input)) {
        //             return response()->json([
        //                 'success' => false,
        //                 'message' => 'Invalid Email or Password',
        //             ], Response::HTTP_UNAUTHORIZED);
        //         }
        //         $user = Auth::user();

        //         Auth::setUser($user);
        //         return $this->respondWithToken($jwt_token);

        // mmmmmmmmmmmmmmm



        // $credentials = request(['email', 'password']);

        // if (!$token = auth()->attempt($credentials)) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // $user = Auth::user();

        // Auth::setUser($user);
        // return $this->respondWithToken($token);

        //under this line code returns full token but can't maintain login

        // $credentials = $request->only('email', 'password');

        // if ($token = JWTAuth::attempt($credentials)) {
        //     return $this->respondWithToken($token);
        // }

        // return response()->json(['error' => 'Unauthorized'], 401);

        //under this code can maintain login but can't return full token
        $credentials = request(['email', 'password']);

        if (auth()->attempt($credentials)) {



            $token = JWTAuth::attempt($credentials);
            return $this->respondWithToken($token);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:5',
            'profile_image' => 'nullable|string',
            'sns_id' => 'nullable|string',
            'sns_type' => 'nullable|string|max:100',
            'self_introduce' => 'nullable|string|max:100',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'messages' => $validator->messages()
            ], 200);
        }

        $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        // return response()->json(auth()->user());
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
            // auth()->guard('api')->factory()->getTTL() * 
        ]);
    }
}
