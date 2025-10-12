<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Dealer;
use App\Models\Contact;
use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    //

    public function index(){

        // $message =  Contact::where('created_at', '>=', Carbon::now()->subHours(24))->count();
        return view("admin.dashboard");
    }


    public function login(){

        return view("admin.login");
    }

    public function authenticate(Request $request){

        // return response()->json($request->all());
         $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $username = $request->input("username");
        $password = $request->input("password");
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            $request->session()->regenerate();
                // return redirect()->intended('admin');
            return redirect()->route("admin");
        }
        return redirect()->back()->with('danger',"creadential is Invalid. Please Try With Valid Creadential.");
    }

    public function register(){
        return view("admin.register");
    }

    public function store(Request $request){
        User::create($request->except("_token"));
        return redirect()->route("admin.login");
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }


    function errorpage(){
        return view('admin.404');
    }







}
