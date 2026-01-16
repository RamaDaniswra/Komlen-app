<?php 
namespace App\Http\Controllers\Admin;

use App\Models\Comic;
use App\Models\Chapter;
use App\Models\User;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
       return view('admin.dashboard', [
        'totalComics' => Comic::count(),
        'totalChapters' => Chapter::count(),
        'totalUsers' => User::count(),
        
        'latestUploads' => Chapter::with('comic')->latest()->take(5)->get(),

        'popularComics' => Comic::orderBy('views_count', 'desc')->take(5)->get()
    ]);
    }
}
