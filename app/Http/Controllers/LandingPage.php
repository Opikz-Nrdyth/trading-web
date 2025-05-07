<?php

namespace App\Http\Controllers;

use App\Models\setting;
use Illuminate\Http\Request;

class LandingPage extends Controller
{
    public function index()
    {
        $company_logo = setting::first()?->company_logo;
        $company_name = setting::first()?->company_name;
        return view('Landing', [
            'company_logo' => $company_logo,
            'company_name' => $company_name
        ]);
    }
}
