<?php

namespace App\Http\Controllers\Auth;

use App\Actions\User\UserCreateAction;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle Social login request
     *
     * @return response
     */
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * Obtain the user information from Social Logged in.
     * @param $social
     * @return Response
     */
    public function handleProviderCallback($social, UserCreateAction $userCreateAction)
    {
        try {
            $user = Socialite::driver($social)->user();
            $newUser = User::where('social_id', $user->id)->first();
            if ($newUser == null) {
                $newUser = $userCreateAction->handle(
                    [
                        'name' => $user->name,
                        'email' => $user->email,
                        'social_id' => $user->id,
                        'auth_type' => $social,
                        'password' => $user->id
                    ]
                );
            }
            Auth::login($newUser);
            return redirect()->route('dashboard');
        } catch (Exception $e) {
            dd($e->getMessage());
            // return redirect()->back()->with('status', $e->getMessage());
        }
    }
}
