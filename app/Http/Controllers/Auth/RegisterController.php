<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EnabledCountry;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Propaganistas\LaravelPhone\Rules\Phone;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/email/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected string $allowedCountry = '';

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $country = EnabledCountry::where('lc_country_id', $data['country_id'])->first();

        $this->allowedCountry = 'IQ';

        if ($country) {
            $country = $country->country;
            $this->allowedCountry = $country->iso_alpha_2;
        }

        //        $phone = phone($data['phone_number'], $this->allowedCountry)->formatE164();
        //        $data['phone_number'] = $phone;

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required',
                (new Phone)->country($this->allowedCountry)->type('mobile'),
                'max:255', 'unique:users,phone_number'],
            'country_id' => ['required', 'exists:enabled_countries,lc_country_id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => ucwords($data['name']),
            'email' => $data['email'],
            'phone_number' => phone($data['phone_number'], $this->allowedCountry, 'E164'),
            'lc_country_id' => $data['country_id'],
            'password' => Hash::make($data['password']),
            //            'email_verified_at' => now(),
        ]);
    }
}
