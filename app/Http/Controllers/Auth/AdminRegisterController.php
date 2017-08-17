<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdminRegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/admin/home';

    public function __construct()
    {
    	$this->middleware('guest:admin');
    }


    public function showRegistrationForm()
    {
        return view('auth.adminRegister');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    protected function guard()
    {
        return Auth::guard('admin');
    }

}
