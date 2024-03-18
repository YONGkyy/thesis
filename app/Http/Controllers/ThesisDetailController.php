<?php

namespace App\Http\Controllers;

use App\Models\ThesisDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $thesisDetails = ThesisDetail::query()
            ->when($request->input('keyword'), fn ($query)
            =>$query->where('Student_ID', 'like', "%" . $request->input('keyword') . "%"))
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('ThesisDetail/Index', [
            'thesisDetails' =>$thesisDetails,
            'filters' => $request->all('keyword'),
        ]);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ThesisDetail/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            "Thesis_No" => "nullable",
            "Student_ID" => "required",
            "Phone" => "required",
            "Defend" => "required",
            "Pass_State" => "required",
            "Issue_Tem_Certificate" => "required",
            "other" => "required",
            "hardwork" => "required",
            "charateristic" => "required",
            "remark" => "required",
            "result" => "required",
        ]);

        // // Create a new Thesis instance
        $thesisDetail = new ThesisDetail();

        // // Assign values from the validated data to the Thesis model instance
        $thesisDetail->Thesis_No = $validatedData['Thesis_No'];
        $thesisDetail->Student_ID = $validatedData['Student_ID'];
        $thesisDetail->Phone = $validatedData['Phone'];
        $thesisDetail->Defend = $validatedData['Defend'];
        $thesisDetail->Pass_State = $validatedData['Pass_State'];
        $thesisDetail->Issue_Tem_Certificate = $validatedData['Issue_Tem_Certificate'];
        $thesisDetail->other = $validatedData['other'];
        $thesisDetail->hardwork = $validatedData['hardwork'];
        $thesisDetail->charateristic = $validatedData['charateristic'];
        $thesisDetail->remark = $validatedData['remark'];
        $thesisDetail->result = $validatedData['result'];

        // // Save the Thesis instance to the database
        $thesisDetail->save();

        // Optionally, you can return a response indicating success or redirect to another page
        // return response()->json(['message' => 'Thesis stored successfully'], 201);
        // return redirect()->route("thesisDetail.index");

        if($request->input('Thesis_No')){
            $thesisDetails = ThesisDetail::findOrFail($request->input("Thesis_No"));
            $thesisDetails->update($validatedData);
        }else {      
            ThesisDetail::create($validatedData);
        }
        return redirect()->route('thesisDetail.index');    }

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
    public function edit(ThesisDetail $thesisDetail)
    {
        return Inertia::render('ThesisDetail/Create', [
            'thesisDetail' =>$thesisDetail
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
    public function destroy(ThesisDetail $thesisDetail)
    {
        $thesisDetail->delete();
        return redirect()->back();
    }
}
