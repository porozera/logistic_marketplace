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

    public function show_faq_peralatan() {
        $faqs = Faq::all(); // Ambil semua FAQ dari database
        // dd($faqs);
        $faqs = Faq::where('type', 'Peralatan')->get();
        return view('pages.admin.faqs.faq-peralatan', compact('faqs'));
    }

    public function show_faq_harga() {
        $faqs = Faq::all(); // Ambil semua FAQ dari database
        // dd($faqs);
        $faqs = Faq::where('type', 'Harga & Pembayaran')->get();
        return view('pages.admin.faqs.faq-harga', compact('faqs'));
    }

    public function show_faq_pengiriman() {
        $faqs = Faq::all(); // Ambil semua FAQ dari database
        // dd($faqs);
        $faqs = Faq::where('type', 'Pengiriman')->get();
        return view('pages.admin.faqs.faq-pengiriman', compact('faqs'));
    }
}
