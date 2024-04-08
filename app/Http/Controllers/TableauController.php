<?php

namespace App\Http\Controllers;

use App\Models\Tableau;
use Illuminate\Http\Request;


class TableauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableaus = Tableau::query()->with('category')->paginate(10);
        return view('users.admin.tableau.index', compact(
            'tableaus'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tableau = new Tableau();
        $categories = Category::all();
        $tableau->fill([
            'quantity' => 0,
            'price' => 0,
        ]);
        $isUpdate = false;
        return view('users.admin.tableau.form', compact(
            'tableau', 'isUpdate', 'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TableauRequest $request)
    {
        $formFields = $request->validated();
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('tableau', 'public');
        }

        Tableau::create($formFields);

        return to_route('tableaus.index')->with('success', 'Tableau created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tableau $tableau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tableau $tableau)
    {
        $isUpdate = true;
        $categories = Category::all();
        return view('users.admin.tableau.form', compact(
            'tableau', 'isUpdate', 'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TableauRequest $request, Tableau $tableau)
    {
        $tableau->fill($request->validated())->save();
        return to_route('tableaus.index')->with('success', 'Tableau updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tableau $tableau)
    {
        $tableau->delete();
        return to_route('tableaus.index')->with('success', 'Tableau deleted successfully');
    }
}

