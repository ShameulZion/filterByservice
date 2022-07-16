<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo;

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
     * Redirect the user to the provider authentication page.
     *
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // Find existing user.
        $existingUser = User::whereEmail($user->getEmail())->first();
        if ($existingUser)
        {
            Auth::login($existingUser);
        } else {
            // Create new user.
            $newUser = User::create([
                'role_id' => Role::where('slug','user')->first()->id,
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'status' => true
            ]);
            // upload images
            if ($user->getAvatar()) {
                $newUser->addMediaFromUrl($user->getAvatar())->toMediaCollection('avatar');
            }
            Auth::login($newUser);
        }
        notify()->success('You have successfully logged in with '.ucfirst($provider).'!','Success');
        return redirect($this->redirectPath());
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->role->id == '1') {
            return redirect()->intended('admin/dashboard');
        } else {
            return redirect()->intended('home');
        }
    }

    public function logout()
    {
        Auth::logout();
        notify()->success('You have successfully logged out','Success');
        return redirect('/');
    }
}
