<?php

namespace App\Http\Controllers;

use App\Models\ThesisCommittee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisCommitteeController extends Controller
{

    public function index(Request $request)
    {
        $thesisCommittees = ThesisCommittee::query()
            ->when($request->input('keyword'), fn ($query)
            =>$query->where('Academic_Year', 'like', "%" . $request->input('keyword') . "%"))
            ->paginate(5)
            ->withQueryString();

            return Inertia::render("ThesisCommittee/Index",[
                "thesisCommittees"=>$thesisCommittees,
                'filters' => $request->all('keyword'),

            ]);
        }

    public function create()
    {
        return Inertia::render('ThesisCommittee/Create');
    }

    public function store(Request $request)
    {
        $validatedData= $request->validate([
            'Academic_Year' => 'required',
            'Major'=> 'required',
            'Committee'=> 'required',
            'Department'=> 'required',
            'Subject'=> 'required',
        ]);

        if($request->input('id')){
            $thesisCommittees = ThesisCommittee::findOrFail($request->input("id"));
            $thesisCommittees->update($validatedData);
        }else {
            ThesisCommittee::create($validatedData);
        }
        return redirect()->route('thesisCommittee.index');
    }
    public function show(string $id)
    {
        //
    }

    public function edit(ThesisCommittee $thesisCommittee)
    {
        return Inertia::render('ThesisCommittee/Create', [
            'thesisCommittee' =>$thesisCommittee
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy($id)
    {
        $thesisCommittee = ThesisCommittee::findOrFail($id);
        $thesisCommittee->delete();
        return redirect()->back();
    }
}
