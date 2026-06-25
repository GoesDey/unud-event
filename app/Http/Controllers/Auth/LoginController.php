<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function index()
   {
      return view('admin.login');
   }

   public function login(Request $request)
   {
      $request->validate([
         'username' => 'required',
         'password' => 'required',
      ]);

      $credentials = [
         'username' => $request->username,
         'password' => $request->password,
      ];

      if (Auth::attempt($credentials)) {
         $request->session()->regenerate();

         return match (Auth::user()->role) {
            // 'super_admin' => redirect()->route('superadmin.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('home'),
         };
      }

      return back()->withErrors([
         'username' => 'Username atau password salah.',
      ]);
   }

   public function logout(Request $request)
   {
      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect()->route('login');
   }
}
