<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;
use App\Company;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Author: Jenkins, A. J. University of Huddersfield.
     * Data: 2020
     * Title: Sample App Final
     * Version: WEEK 18
     * Type: Source code
     * Availability: https://huddersfield.brightspace.com/d2l/le/content/65955/viewContent/518254/View.
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }


    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $user = User::firstOrCreate(['email' => $user->getEmail()], [
            'name' => $user->getName(),
            'google_id' => $user->getId(),
            'email' => $user->getEmail(),
            'password' => bcrypt(Str::random(32)),
            'role_id' => 1,
        ]);

        $company = Company::firstOrCreate(['name' => "Personal use", 'user_id' => $user->id]);
        if ($company->wasRecentlyCreated) {
            $company->users()->attach($company->id);
            //set this company as default.
            User::findOrFail($user->id)->update(['company_id' => $company->id]);
        }

        auth()->login($user, true);
        return redirect()->to('/home');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('status', 'You have been logged out');
    }
}
