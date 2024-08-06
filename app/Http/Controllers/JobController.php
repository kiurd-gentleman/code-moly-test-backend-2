<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use App\Pipelines\JobSearchPipeline;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = JobSearchPipeline::apply(Job::query())->paginate(10);
        return response()->json($jobs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'location' => 'required|string|max:255',
            'job_type_id' => 'required|exists:job_types,id',
            'category_id' => 'required|exists:categories,id',
            'salary_min' => 'required|integer',
            'salary_max' => 'required|integer',
            'experience_level' => 'required|integer',
            'industry' => 'required|string|max:255',
            'benefits' => 'required|array',
            'skills' => 'required|array',
            'description' => 'required|string',
        ]);

        $job = Job::create($request->all());
        return response()->json($job, 201);
    }

    public function show($id)
    {
        $job = Job::with(['company', 'category','jobType'])->findOrFail($id);
        return response()->json($job);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'location' => 'required|string|max:255',
            'job_type_id' => 'required|exists:job_types,id',
            'category_id' => 'required|exists:categories,id',
            'salary_min' => 'required|integer',
            'salary_max' => 'required|integer',
            'experience_level' => 'required|integer',
            'industry' => 'required|string|max:255',
            'benefits' => 'required|array',
            'skills' => 'required|array',
            'description' => 'required|string',
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

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $jobs = Job::where('title', 'like', "%{$request->query}%")
            ->orWhere('location', 'like', "%{$request->query}%")
            ->orWhere('industry', 'like', "%{$request->query}%")
            ->with('company')
            ->paginate(10);

        return response()->json($jobs);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'job_type_id' => 'required|exists:job_types,id',
            'experience_level' => 'required|integer',
        ]);

        $jobs = Job::where('category_id', $request->category_id)
            ->where('job_type_id', $request->job_type_id)
            ->where('experience_level', $request->experience_level)
            ->with('company')
            ->paginate(10);

        return response()->json($jobs);
    }

    public function apply(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'resume' => 'required|file',
        ]);

        $job = Job::findOrFail($id);
        $job->applicants()->create($request->all());
        return response()->json(null, 201);
    }

    public function applicants($id)
    {
        $job = Job::findOrFail($id);
        $applicants = $job->applicants()->paginate(10);
        return response()->json($applicants);
    }

    public function applicant($jobId, $applicantId)
    {
        $job = Job::findOrFail($jobId);
        $applicant = $job->applicants()->findOrFail($applicantId);
        return response()->json($applicant);
    }

    public function categoryIndex()
    {
        $category = Category::get();
        return response()->json($category);
    }

    public function jobTypeIndex()
    {
        $jobType = JobType::get();
        return response()->json($jobType);
    }
}
