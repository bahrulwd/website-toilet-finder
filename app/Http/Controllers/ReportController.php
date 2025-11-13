<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        // Ambil semua report beserta relasi user dan toilet
        $reports = Report::with(['user', 'toilet'])->orderBy('created_at', 'desc')->get();
        return view('report', compact('reports'));
    }

    public function show($id)
    {
        $report = Report::with(['user', 'toilet'])->findOrFail($id);
        return view('report_show', compact('report'));
    }
}