<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use App\Models\CaseStudy;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Получаем активные услуги, отсортированные по порядку
        $services = Service::active()->ordered()->take(3)->get();
        
        // Получаем активные отзывы, отсортированные по порядку
        $testimonials = Testimonial::active()->ordered()->take(4)->get();
        
        // Получаем активные кейсы, отсортированные по порядку
        $caseStudies = CaseStudy::active()->ordered()->take(3)->get();
        
        // Получаем последние опубликованные статьи
        $latestPosts = Post::published()->latest()->take(3)->get();
        
        return view('home', compact('services', 'testimonials', 'caseStudies', 'latestPosts'));
    }
}
