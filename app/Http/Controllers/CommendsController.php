<?php

namespace App\Http\Controllers;

use App\Models\commends;
use App\Models\Tableaus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommendsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
     public function index()
     {
         $commands = commends::with(['Tableau', 'food', 'accessoir'])->paginate(4);
     
         return view('command.index', compact('commands'));
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
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez vous connecter pour passer une commande.');
        }
        
        $TableauId = $request->input('Tableau_id');
        $userId = Auth::id();
    
        $Tableau = Tableaus::findOrFail($TableauId);
    
        
        
        commends::create([
            'Tableaus_id' => $TableauId,
            'user_id' => $userId,
            'total_price' => $Tableau->price 
        ]);
    
        return redirect()->back()->with('success', 'Votre commande a été passée avec succès.');
    }

    public function storeFoods(Request $request)
{
   
}
public function storeAccessoir(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez vous connecter pour passer une commande.');
    }
    
    $accessoirId = $request->input('accessoir_id');
    $userId = Auth::id();

    // Assuming you have an Accessoir model
    $accessoir = Accessoir::findOrFail($accessoirId);

    commends::create([
        
        'accessoir_id' => $accessoirId,
        'user_id' => $userId,
        'total_price' => $accessoir->price, 
    ]);

    return redirect()->back()->with('success', 'Votre commande d\'accessoire a été passée avec succès.');
     
}

public function storeFood(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez vous connecter pour passer une commande.');
    }
    
    $foodId = $request->input('food_id');
    //dd($foodId);
    $userId = Auth::id();

    // Assuming you have a Food model
    $food = Food::findOrFail($foodId);
//dd($food);
    commends::create([
        'food_id' => $foodId,
        'user_id' => $userId,
        'total_price' => $food->price, 
    ]);

    return redirect()->back()->with('success', 'Votre commande de nourriture a été passée avec succès.');
}


    /**
     * Display the specified resource.
     */
    public function show(commends $commends)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(commends $commends)
    {
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, commends $command) 
    {
        
 
       
    
        //return redirect()->back()->with('status', 'Update successful');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(commends $Commande)
    {
        $Commande->delete();
        return redirect()->back()->with('success', 'Votre commande a été suprimer avec succès.');

    }
}