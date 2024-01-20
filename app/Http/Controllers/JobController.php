<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
    }

    public function create()
    {
        return view('backend.jobs.create');
    }

    public function store(Request $request, Job $job)
    {
        dd($request->toArray());
    }
}
