<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Получаем активные отзывы, отсортированные по порядку
        $testimonials = Testimonial::active()->ordered()->take(6)->get();
        
        return view('about', compact('testimonials'));
    }
}
