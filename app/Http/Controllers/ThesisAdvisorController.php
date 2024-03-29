<?php

namespace App\Http\Controllers;

use App\Models\ThesisAdvisor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisAdvisorController extends Controller
{
    public function index(Request $request)
    {
        $thesisAdvisors = ThesisAdvisor::query()
            ->when($request->input('keyword'), fn ($query)
            =>$query->where('Academic_Year', 'like', "%" . $request->input('keyword') . "%"))
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('ThesisAdvisor/Index', [
            'thesisAdvisors' =>$thesisAdvisors,
            'filters' => $request->all('keyword'),
        ]);
    }

    public function create()
    { 
        return Inertia::render('ThesisAdvisor/Index');
    }

    public function store(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            "Academic_Year" => "required",
            "Advisor" =>  "required",
            "College" =>  "required",
            "Department" => "required",
        ]);


        // // // Create a new Thesis instance
        // $thesisAdvisor = new ThesisAdvisor();

        // // // Assign values from the validated data to the Thesis model instance
        // $thesisAdvisor->Academic_Year = $validatedData['Academic_Year'];
        // $thesisAdvisor->Advisor = $validatedData['Advisor'];
        // $thesisAdvisor->College = $validatedData['College'];
        // $thesisAdvisor->Department = $validatedData['Department'];

        // $thesisAdvisor->save();

        if($request->input('id')){
            $thesisAdvisors = ThesisAdvisor::findOrFail($request->input("id"));
            $thesisAdvisors->update($validatedData);
        }else {      

            ThesisAdvisor::create($validatedData);
        }
        return redirect()->route('thesisAdvisor.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(ThesisAdvisor $thesisAdvisor)
    {
        return Inertia::render('ThesisAdvisor/Index', [
            'thesisAdvisor' =>$thesisAdvisor
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy($id)
    {
        $thesisAdvisor = ThesisAdvisor::findOrFail($id);
        $thesisAdvisor->delete();
        return redirect()->back();    
    }
}

