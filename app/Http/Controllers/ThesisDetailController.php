<?php

namespace App\Http\Controllers;

use App\Models\ThesisDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisDetailController extends Controller
{
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

    public function create()
    {
        return Inertia::render('ThesisDetail/Create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "Thesis_No" => "required",
            "Student_ID" => "required",
            "Phone" => "required",
            "Defend" => "required",
            "Pass_State" => "required",
            "Issue_Tem_Certificate" => "required",
            "Other" => "required",
            "Hardwork" => "required",
            "Charateristic" => "required",
            "Remark" => "required",
            "Result" => "required",
        ]);

        // $thesisDetail = new ThesisDetail();

        // $thesisDetail->Thesis_No = $validatedData['Thesis_No'];
        // $thesisDetail->Student_ID = $validatedData['Student_ID'];
        // $thesisDetail->Phone = $validatedData['Phone'];
        // $thesisDetail->Defend = $validatedData['Defend'];
        // $thesisDetail->Pass_State = $validatedData['Pass_State'];
        // $thesisDetail->Issue_Tem_Certificate = $validatedData['Issue_Tem_Certificate'];
        // $thesisDetail->Other = $validatedData['Other'];
        // $thesisDetail->Hardwork = $validatedData['Hardwork'];
        // $thesisDetail->Charateristic = $validatedData['Charateristic'];
        // $thesisDetail->Remark = $validatedData['Remark'];
        // $thesisDetail->Result = $validatedData['Result'];

        // $thesisDetail->save();

        if($request->input('id')){
            $thesisDetails = ThesisDetail::findOrFail($request->input("id"));
            $thesisDetails->update($validatedData);
        }else {      
            ThesisDetail::create($validatedData);
        }
        return redirect()->route('thesisDetail.index');    }

    public function show(string $id)
    {
        //
    }

    public function edit(ThesisDetail $thesisDetail)
    {
        return Inertia::render('ThesisDetail/Create', [
            'thesisDetail' =>$thesisDetail
        ]);    
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy($id)
    {
        $thesisDetail = ThesisDetail::findOrFail($id);
        $thesisDetail->delete();
        return redirect()->back();
    }
}
