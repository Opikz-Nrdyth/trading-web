<?php

namespace App\Http\Controllers;

use App\Models\faq;
use App\Models\news;
use App\Models\setting;
use App\Models\testimonial;
use Illuminate\Http\Request;

class LandingPage extends Controller
{
    public function index()
    {
        $company_logo = setting::first()?->company_logo;
        $company_name = setting::first()?->company_name;

        $testimonials = testimonial::all();
        $news = news::where('status', 'publish')->orderBy('created_at', 'desc')->take(10)->get();
        $faq = faq::all();

        return view('Landing', [
            'company_logo' => $company_logo,
            'company_name' => $company_name,
            'testimonials' => $testimonials,
            'news' => $news,
            'faq' => $faq
        ]);
    }

    public function news($id = null)
    {
        $company_logo = setting::first()?->company_logo;
        $company_name = setting::first()?->company_name;
        $newsSearch = null;
        $newsAll = News::where('id', '!=', $id)->where('status', 'publish')->orderBy('created_at', 'desc')->get();


        if ($id) {
            $newsSearch = news::where('id', $id)->first();
        }

        if (!$id) {
            $newsAll = news::all();
        }

        return view('news', [
            'company_logo' => $company_logo,
            'company_name' => $company_name,
            'id' => $id,
            'newsSearch' => $newsSearch,
            'news' => $newsAll,
        ]);
    }

    public function about()
    {
        $company_logo = setting::first()?->company_logo;
        $company_name = setting::first()?->company_name;

        return view('about', [
            'company_logo' => $company_logo,
            'company_name' => $company_name,
        ]);
    }
}
