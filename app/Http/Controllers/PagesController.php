<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
    
    public function dashboard()
    {
        return view('pages.dashboard');
    }

    public function users()
    {
        return view('pages.users');
    }

    public function roles()
    {
        return view('pages.roles');
    }

    public function permissions()
    {
        return view('pages.permissions');
    }

    public function departments()
    {
        return view('pages.departments');
    }

    public function companies()
    {
        return view('pages.companies');
    }

    public function licenses()
    {
        return view('pages.licenses');
    }

    public function oranges()
    {
        return view('pages.oranges');
    }

    public function devices()
    {
        return view('pages.devices');
    }

    public function patchs()
    {
        return view('pages.patchs');
    }

    public function switchs()
    {
        return view('pages.switchs');
    }

    public function ips()
    {
        return view('pages.ips');
    }

    public function edokis()
    {
        return view('pages.edokis');
    }

    public function emadEdeens()
    {
        return view('pages.emad-edeens');
    }
    
    public function points()
    {
        return view('pages.points');
    }
}
