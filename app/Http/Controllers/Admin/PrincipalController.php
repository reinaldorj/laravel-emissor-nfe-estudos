<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index()
    {
        $data['breadcrumb'][] = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['title'] = 'Dashboard';
        return view('admin.pages.principal.index', $data);
    }
}
