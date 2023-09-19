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
    
}
