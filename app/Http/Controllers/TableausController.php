<?php

namespace App\Http\Controllers;

use App\Models\Tableaus;
use App\Models\Categories;
use Illuminate\Http\Request;

class TableausController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('query');
        $category = $request->input('category');
        $sex = $request->input('sex');
        $age = $request->input('age'); 
    
        $TableausQuery = Tableaus::query();
    
        if (!empty($search)) {
            $TableausQuery->where('name', 'LIKE', '%' . $search . '%')
                          ->orWhere('price', 'LIKE', '%' . $search . '%');
        }
    
        if (!empty($category)) {
            $TableausQuery->where('category_id', $category);
        }
    
        if (!empty($sex)) {
            $TableausQuery->where('sex', $sex);
        }

        if (!empty($age)) {
            if ($age == '2-6') {
                $TableausQuery->whereBetween('age', [2, 6]);
            } elseif ($age == '7-10') {
                $TableausQuery->whereBetween('age', [7, 10]);
            } elseif ($age == '10+') {
                $TableausQuery->where('age', '>', 10);
            }
        }
    

        $Tableaus =  $TableausQuery->orderBy('created_at', 'DESC')->get();
//dd($Tableaus);
        $categories = Categories::with('Tableaus')->has('Tableaus')->get();
    
 
        return view('welcome', compact('Tableaus', 'categories'));
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        
        $Tableaus = Tableaus::findOrFail($id);
    //dd($Tableaus);
         $comments = comments::all();
        return view('Pets.Show', compact('Tableaus','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tableaus $Tableaus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tableaus $Tableaus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tableaus $Tableaus)
    {
        //
    }


  
}
