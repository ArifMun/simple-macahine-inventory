<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Brand;
use App\Models\Machine;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $url = 'dashboard';
        $count_machine = Machine::count();
        $count_type = Type::count();
        $count_brand = Brand::count();
        return view('dashboard.index', compact('url', 'count_machine', 'count_type', 'count_brand'));
    }
}
