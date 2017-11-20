<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Dto\AuthPlatform;
use App\Services\Users\SocialUsers;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($authType)
    {
        switch ($authType) {
            case 'github':
                return Socialite::driver('github')->redirect();
                break;
            case 'twitter':
                return Socialite::driver('twitter')->redirect();
                break;
        }

    }

    public function handleProviderCallback($authType, SocialUsers $service)
    {
        switch ($authType) {
            case 'github':
                $account = Socialite::driver('github')->user();
                $user = $service->createUser($account, 'github');
                break;

            case 'twitter':
                $account = Socialite::driver('twitter')->user();
                $account->email = "{$account->nickname}@twitter-dummy.com";
                $user = $service->createUser($account, 'twitter');
                break;
        }

        if(!$user) {
            return redirect('/login');
        }

        \Auth::login(User::find($user->id()));
        return redirect('/home');
    }
}
