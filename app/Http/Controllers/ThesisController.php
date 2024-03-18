<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $thesises = Thesis::query()
            ->when($request->input('keyword'), fn ($query)
            =>$query->where('Department', 'like', "%" . $request->input('keyword') . "%"))
            ->paginate(3)
            ->withQueryString();
    
        return Inertia::render('Thesis/Index', [
            'thesises' => $thesises,
            'filters' => $request->all('keyword'),
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Thesis/Create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            // Define validation rules for each field if needed
            'N' => 'nullable',
            'Thesis_No' => 'required',
            'Thesis_Group' =>  'required',
            'Academic_Year' => 'required',
            'Department' => 'required',
            'Major' => 'required',
            'Year' => 'required',
            'Batch' => 'required',
            'Session' => 'required',
            'Organizaition' => 'required',
            'Organization_Type' => 'required',
            'Location' => 'required',
            'Organization_Phone' => 'required',
            'Title' => 'required',
            'Title_Khmer' => 'required',
            'Objective' => 'required',
            'Objective_Khmer' => 'required',
            'Summary' => 'required',
            'Submit_Date' => 'required',
            'Teacher_id' => 'required',
            'Defend_Date' => 'required',
            'Book_Score' => 'required',
            'Defend_time' => 'required',
            'Submit_book' => 'required',
            'Building' => 'required',
            'Room' => 'required',            
        ]);

        $thesis = new Thesis();

        $thesis->N = $validatedData['N'];
        $thesis->Thesis_No = $validatedData['Thesis_No'];
        $thesis->Thesis_Group = $validatedData['Thesis_Group'];
        $thesis->Academic_Year = $validatedData['Academic_Year'];
        $thesis->Department = $validatedData['Department'];
        $thesis->Major = $validatedData['Major'];
        $thesis->Year = $validatedData['Year'];
        $thesis->Batch = $validatedData['Batch'];
        $thesis->Session = $validatedData['Session'];
        $thesis->Organizaition = $validatedData['Organizaition'];
        $thesis->Organization_Type = $validatedData['Organization_Type'];
        $thesis->Location = $validatedData['Location'];
        $thesis->Organization_Phone = $validatedData['Organization_Phone'];
        $thesis->Title = $validatedData['Title'];
        $thesis->Title_Khmer = $validatedData['Title_Khmer'];
        $thesis->Objective = $validatedData['Objective'];
        $thesis->Objective_Khmer = $validatedData['Objective_Khmer'];
        $thesis->Summary = $validatedData['Summary'];
        $thesis->Submit_Date = $validatedData['Submit_Date'];
        $thesis->Teacher_id = $validatedData['Teacher_id'];
        $thesis->Defend_Date = $validatedData['Defend_Date'];
        $thesis->Book_Score = $validatedData['Book_Score'];
        $thesis->Defend_time = $validatedData['Defend_time'];
        $thesis->Submit_book = $validatedData['Submit_book'];
        $thesis->Building = $validatedData['Building'];
        $thesis->Room = $validatedData['Room'];

        $thesis->save();

        if($request->input('N')){
            $thesises = Thesis::findOrFail($request->input("N"));
            $thesises->update($validatedData);
        }else {      
            Thesis::create($validatedData);
        }
        return redirect()->route("thesis.index");
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
    public function edit(Thesis $thesis)
    {
        return Inertia::render('Thesis/Create', [
            'thesis' => $thesis
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $N)
    {  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thesis $thesis)
    {
        $thesis->delete();
        return redirect()->back();
    }
}
