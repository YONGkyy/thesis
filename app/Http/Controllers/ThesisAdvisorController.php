<?php

namespace App\Http\Controllers;

use App\Models\ThesisAdvisor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisAdvisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $thesisAdvisors = ThesisAdvisor::query()
            ->when($request->input('keyword'), fn ($query)
            =>$query->where('Department', 'like', "%" . $request->input('keyword') . "%"))
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('ThesisAdvisor/Index', [
            'thesisAdvisors' =>$thesisAdvisors,
            'filters' => $request->all('keyword'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        return Inertia::render('ThesisAdvisor/Index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            "Academic_year" => "nullable",
            "n" => "required",
            "College" =>  "required",
            "Department" => "required",
            "Advisor" =>  "required",
        ]);

        // // Create a new Thesis instance
        $thesisAdvisor = new ThesisAdvisor();

        // // Assign values from the validated data to the Thesis model instance
        $thesisAdvisor->Academic_year = $validatedData['Academic_year'];
        $thesisAdvisor->n = $validatedData['n'];
        $thesisAdvisor->College = $validatedData['College'];
        $thesisAdvisor->Department = $validatedData['Department'];
        $thesisAdvisor->Advisor = $validatedData['Advisor'];

        // // Save the Thesis instance to the database
        $thesisAdvisor->save();

        // Optionally, you can return a response indicating success or redirect to another page
        // return response()->json(['message' => 'Thesis stored successfully'], 201);
        // return redirect()->route("thesisAdvisor.index");

        if($request->input('Academic_year')){
            $thesisAdvisors = ThesisAdvisor::findOrFail($request->input("Academic_year"));
            $thesisAdvisors->update($validatedData);
        }else {      
            ThesisAdvisor::create($validatedData);
        }
        return redirect()->route('thesisAdvisor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ThesisAdvisor $thesisAdvisor)
    {
        return Inertia::render('ThesisAdvisor/Index', [
            'thesisAdvisor' =>$thesisAdvisor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThesisAdvisor $thesisAdvisor)
    {
        $thesisAdvisor->delete();
        return redirect()->back();    
    }
}

