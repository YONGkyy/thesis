<?php

namespace App\Http\Controllers;

use App\Models\ThesisAdvisor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisAdvisorController extends Controller
{

    public function index()
    {
        // $thesisAdvisors = ThesisAdvisor::query()
        //     ->orderBy('Academic_Year', 'desc')
        //     ->when(request()->input('academic_year'), fn ($query) =>
        //     $query->where('Academic_Year', request()->input('academic_year')))
        //     ->when(request()->input('advisor'), fn ($query) =>
        //     $query->where('Advisor', request()->input('advisor')))
        //     ->when(request()->input('department'), fn ($query) =>
        //     $query->where('Department', request()->input('department')))
        //     ->paginate(2);
        $thesisAdvisors = ThesisAdvisor::query()
            ->orderBy('Academic_Year', 'desc')
            ->when(
                request()->input('academic_year'),
                fn ($query) =>
                $query->where('Academic_Year', request()->input('academic_year'))
            )
            ->when(
                request()->input('advisor'),
                fn ($query) =>
                $query->where('Advisor', request()->input('advisor'))
            )
            ->when(
                request()->input('department'),
                fn ($query) =>
                $query->where('Department', request()->input('department'))
            )->paginate(10);




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

        // return $thesisAdvisors;

        return Inertia::render('ThesisAdvisor/Index', [
            'thesisAdvisors' => $thesisAdvisors,
            'academic_options' => $academic_years,
            'advisor_options' => $advisors,
            'department_options' => $departments,
            'filters' => request()->all('academic_year', 'advisor', 'department'),
        ]);
    }


    public function create()
    {
        return Inertia::render('ThesisAdvisor/Index');
    }

    public function store(Request $request, $id = null)
    {
        // try {
        // Validate the incoming request data
        $validatedData = $request->validate([
            "Academic_Year" => "required",
            "Advisor" => "required",
            "College" =>  "required",
            "Department" => "required",
        ]);

        $data = [
            "Academic_Year" => $request->input('Academic_Year'),
            "Advisor" => $request->input('Advisor'),
            "College" => $request->input('College'),
            "Department" => $request->input('Department'),
        ];
        // If $id is provided, update the existing record; otherwise, create a new record
        $thesisAdvisor = ThesisAdvisor::updateOrCreate(['id' => $id], $data);

        return redirect()->route('thesisAdvisor.index');
        // } catch (QueryException $e) {
        //     if ($e->errorInfo[1] === 1062) { // 1062 is the MySQL error code for a duplicate entry
        //         return redirect()->back()->withErrors(['Advisor' => 'The Advisor already exists.'])->withInput();
        //     }
        //     throw $e;
        // }
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
