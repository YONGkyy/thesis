<?php

namespace App\Http\Controllers;

use App\Models\ThesisAdvisor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisAdvisorController extends Controller
{

    public function index()
    {
        //
        $thesisAdvisors = ThesisAdvisor::query()
            ->orderBy('Academic_Year', 'desc')
            ->when(request()->input('academic_year'), fn ($query)
            =>$query->where('Academic_Year', request()->input('academic_year')))
            ->when(request()->input('advisor'), fn ($query) =>
            $query->where('Advisor', request()->input('advisor')))
            ->when(request()->input('department'), fn ($query) =>
            $query->where('Department', request()->input('department')))
            ->paginate(5);
        $academic_years = ThesisAdvisor::query()
            ->selectRaw('Academic_Year')
            ->distinct()
            ->orderBy('Academic_Year', 'desc')
            ->pluck('Academic_Year');

        $advisors = ThesisAdvisor::query()
            ->selectRaw('Advisor')
            ->distinct()
            ->orderBy('Advisor', 'asc')
            ->pluck('Advisor');

        $departments = ThesisAdvisor::query()
            ->selectRaw('Department')
            ->distinct()
            ->orderBy('Department', 'asc')
            ->pluck('Department');



        return Inertia::render('ThesisAdvisor/Index', [
            'thesisAdvisors' => $thesisAdvisors,
            'academic_options' => $academic_years,
            'advisor_options' => $advisors,
            'department_options' => $departments,
            'filters' => request()->all('academic_year', 'advisor', 'department')
        ]);
    }
    public function create()
    {
        return Inertia::render('ThesisAdvisor/Index');
    }

    public function store(Request $request, $id = null)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            "Academic_Year" => "required",
            "Advisor" =>  "required",
            "College" =>  "required",
            "Department" => "required",
        ]);

        if ($id) {
            $thesisAdvisor = ThesisAdvisor::findOrFail($id);
            $thesisAdvisor->update($validatedData);
        } else {
            ThesisAdvisor::create($validatedData);
        }

        return redirect()->route('thesisAdvisor.index');
    }


    public function edit(string $id)
    {
        return ThesisAdvisor::findOrFail($id);
    }

    public function destroy(string $id)
    {
        $thesisAdvisor = ThesisAdvisor::findOrFail($id);
        $thesisAdvisor->delete();
        return redirect()->back();
    }
}
