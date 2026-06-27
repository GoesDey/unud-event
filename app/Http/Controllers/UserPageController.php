<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function indexEvent() {

        return view('user.events');
    }
}
