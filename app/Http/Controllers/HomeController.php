<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accesses = Entity::select(\DB::raw('sum(page_views) as total'))->first();
        $pages = Entity::orderBy('page_views')->first(['title', 'page_views']);

        return view('home', [
            'total_accesses' => $accesses->total,
            'popular_page' => $pages->title,
        ]);
    }
}
