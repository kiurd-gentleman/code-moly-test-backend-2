<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('company')->paginate(10);
        return response()->json($jobs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'salary_min' => 'required|integer',
            'salary_max' => 'required|integer',
            'experience_level' => 'required|integer',
            'industry' => 'required|string|max:255',
            'benefits' => 'required|array',
            'skills' => 'required|array',
        ]);

        $job = Job::create($request->all());
        return response()->json($job, 201);
    }

    public function show($id)
    {
        $job = Job::with('company')->findOrFail($id);
        return response()->json($job);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'salary_min' => 'required|integer',
            'salary_max' => 'required|integer',
            'experience_level' => 'required|integer',
            'industry' => 'required|string|max:255',
            'benefits' => 'required|array',
            'skills' => 'required|array',
        ]);

        $job = Job::findOrFail($id);
        $job->update($request->all());
        return response()->json($job);
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return response()->json(null, 204);
    }
}
