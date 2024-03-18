<?php

namespace App\Http\Controllers;

use App\Models\ThesisCommittee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisCommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $thesisCommittees = ThesisCommittee::query()
            ->when($request->input('keyword'), fn ($query)
            =>$query->where('Department', 'like', "%" . $request->input('keyword') . "%"))
            ->paginate(5)
            ->withQueryString();

            return Inertia::render("ThesisCommittee/Index",[
                "thesisCommittees"=>$thesisCommittees,
                'filters' => $request->all('keyword'),

            ]);
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ThesisCommittee/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData= $request->validate([
            // 'Academic'=> 'nullable',
            'Academic_year' => 'nullable',
            'Department'=> 'required',
            'Major'=> 'required',
            'Committee'=> 'required',
            'Subject'=> 'required',
        ]);
        // // Create a new Thesis instance
        $thesisCommittee = new ThesisCommittee();

        // // Assign values from the validated data to the Thesis model instance
        $thesisCommittee->Academic_year = $validatedData['Academic_year'];
        // $thesisCommittee->Academic_year = $validatedData['Academic']; 
        $thesisCommittee->Department = $validatedData['Department'];
        $thesisCommittee->Major = $validatedData['Major'];
        $thesisCommittee->Committee = $validatedData['Committee'];
        $thesisCommittee->Subject = $validatedData['Subject'];

        // // Save the Thesis instance to the database
        $thesisCommittee->save();

        if($request->input('Academic_year')){
            $thesisCommittees = ThesisCommittee::findOrFail($request->input("Academic_year"));
            $thesisCommittees->update($validatedData);
        }else {      
            ThesisCommittee::create($validatedData);
        }
        return redirect()->route('thesisCommittee.index');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $Academic_Year)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ThesisCommittee $thesisCommittee)
    {
        // return ThesisCommittee::findOrFail($Academic_Year);
        return Inertia::render('ThesisCommittee/Create', [
            'thesisCommittee' =>$thesisCommittee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $Academic_Year)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThesisCommittee $thesisCommittee)
    {
        $thesisCommittee->delete();
        return redirect()->back();  

        // ThesisCommittee::findOrFail($Academic_Year)->delete();
        // return redirect()->back();
    }
}
