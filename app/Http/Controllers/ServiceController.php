<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Получаем все активные услуги, отсортированные по порядку
        $services = Service::active()->ordered()->get();
        
        return view('services.index', compact('services'));
    }

    /**
     * Display the specified service.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\View\View
     */
    public function show(Service $service)
    {
        // Проверяем, что услуга активна
        if (!$service->is_active) {
            abort(404);
        }
        
        // Получаем другие активные услуги для блока "Другие услуги"
        $otherServices = Service::active()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->take(3)
            ->get();
        
        return view('services.show', compact('service', 'otherServices'));
    }
}
