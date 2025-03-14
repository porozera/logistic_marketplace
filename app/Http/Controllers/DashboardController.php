<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index_customer()
    {
        return view('welcome');
    }

    public function index_admin()
    {
        return view('pages.admin.dashboards.dashboard');
    }

    public function faq_category() {
        return view('landing-faq');
    }

    public function show_faq_general() {
        $faqs = Faq::all(); // Ambil semua FAQ dari database
        // dd($faqs);
        $faqs = Faq::where('type', 'General')->get();
        return view('pages.admin.faqs.faq-general', compact('faqs'));
    }
}
