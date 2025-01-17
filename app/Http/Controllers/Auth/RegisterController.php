<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\user_role_pengguna;
use App\Models\user_tajuk_mesyuarat;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'ic' => ['required', 'string', 'max:255', 'unique:users'],
            'jawatan' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_telefon' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:255'],
            'status'  => ['required', 'max:1'],

            'role_pengguna' => ['required', 'array'],
            'tajuk_mesyuarat' => ['required', 'array'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'ic'  => $data['ic'],
            'email' => $data['email'],
            'jawatan' => $data['jawatan'],
            'no_telefon' => $data['no_telefon'],
            'unit' => $data['unit'],
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
        ]);

        $id_user = $user->id;

        $tajuk_mesyuarat = $data['tajuk_mesyuarat'];
        foreach ($tajuk_mesyuarat as $tajuk) {
            $user_tajuk_mesyuarat = new user_tajuk_mesyuarat();
            $user_tajuk_mesyuarat->id_user = $id_user;
            $user_tajuk_mesyuarat->id_tajuk = $tajuk;
            $user_tajuk_mesyuarat->save();
        }

        $role_pengguna = $data['role_pengguna'];
        foreach ($role_pengguna as $peranan) {
            $user_role_pengguna = new user_role_pengguna();
            $user_role_pengguna->id_user = $id_user;
            $user_role_pengguna->id_peranan = $peranan;
            $user_role_pengguna->save();
        }

        $user = User::orderBy('id', 'desc')
            ->get();

        $role_pengguna = user_role_pengguna::join('users', 'users.id', '=', 'user_role_pengguna.id_user')
            ->get();

        $tajuk_mesyuarat = user_tajuk_mesyuarat::join('users', 'users.id', '=', 'user_tajuk_mesyuarat.id_user')
            ->get();


        return compact('user', 'user_role_pengguna', 'user_tajuk_mesyuarat');
    }
}
