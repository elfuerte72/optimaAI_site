<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    /**
     * Display a listing of the case studies.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Получаем все активные кейсы, отсортированные по порядку
        $caseStudies = CaseStudy::active()->ordered()->paginate(9);
        
        return view('case-studies.index', compact('caseStudies'));
    }

    /**
     * Display the specified case study.
     *
     * @param  \App\Models\CaseStudy  $caseStudy
     * @return \Illuminate\View\View
     */
    public function show(CaseStudy $caseStudy)
    {
        // Проверяем, что кейс активен
        if (!$caseStudy->is_active) {
            abort(404);
        }
        
        // Получаем другие активные кейсы для блока "Другие кейсы"
        $relatedCaseStudies = CaseStudy::active()
            ->where('id', '!=', $caseStudy->id)
            ->ordered()
            ->take(3)
            ->get();
        
        return view('case-studies.show', compact('caseStudy', 'relatedCaseStudies'));
    }
}
