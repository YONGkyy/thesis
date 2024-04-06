<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use App\Models\ThesisAdvisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ThesisController extends Controller
{
    public function index(Request $request)
    {
        $thesises = Thesis::query()
            ->when($request->input('keyword'), fn ($query)
            => $query->where('Department', 'like', "%" . $request->input('keyword') . "%"))
            ->paginate(5)
            ->withQueryString();


        $advisors = ThesisAdvisor::query()
            ->select('id', 'Advisor')
            ->get();
        return $advisors;
        return Inertia::render('Thesis/Index', [
            'thesises' => $thesises,
            'filters' => $request->all(
                'keyword'
            ),
        ]);
    }

    public function create()
    {
        return Inertia::render('Thesis/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Thesis_No' => 'required',
            'Thesis_Group' =>  'nullable',
            'Academic_Year' => 'nullable',
            'Department' => 'nullable',
            'Major' => 'nullable',
            'Year' => 'nullable',
            'Batch' => 'nullable',
            'Session' => 'nullable',
            'Organizaition' => 'nullable',
            'Organization_Type' => 'nullable',
            'Location' => 'nullable',
            'Organization_Phone' => 'nullable',
            'Title' => 'nullable',
            'Title_Khmer' => 'nullable',
            'Objective' => 'nullable',
            'Objective_Khmer' => 'nullable',
            'Summary' => 'nullable',
            'Submit_Date' => 'nullable',
            'Teacher_id' => 'nullable',
            'Defend_Date' => 'nullable',
            'Book_Score' => 'nullable',
            'Defend_time' => 'nullable',
            'Submit_book' => 'nullable',
            'Building' => 'nullable',
            'Room' => 'nullable',
        ]);

        if ($request->input('id')) {
            $thesises = Thesis::findOrFail($request->input("id"));
            $thesises->update($validatedData);
        } else {
            Thesis::create($validatedData);
        }
        return redirect()->route("thesis.index");
    }
    public function show(string $id)
    {
        //
    }
    public function edit(Thesis $thesis)
    {
        return Inertia::render('Thesis/Create', [
            'thesis' => $thesis,
        ]);
    }
    public function update(Request $request, string $id)
    {
    }
    public function destroy($id)
    {
        $thesis = Thesis::findOrFail($id);
        $thesis->delete();
        return redirect()->back();
    }
}
