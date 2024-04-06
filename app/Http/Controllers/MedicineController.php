<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MedicineController extends Controller
{
    public function index()
    {
        // Retrieve all medicines using the Medicine model
        //$medicines = Medicine::all();

        // Pass the retrieved data to the view using Inertia
        return Inertia::render('Medicines/Index', [
            'medicines' => Medicine::all()->map(function($medicine){
                return[
                    'id' => $medicine->id,
                    'name' => $medicine->name,
                    'price' => $medicine->price,
                    'quantity' => $medicine->quantity,
                    'dosage' => $medicine->dosage,
                    'expdate' => $medicine->expdate,
                ];
            }) // Passing 'medicines' instead of 'medicine' for better readability
        ]);
    }

    public function create()
    {
        return Inertia::render('Medicines/Create');
    }

    public function store(Request $request)
    {
        Medicine::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'dosage' => $request->dosage,
            'expdate' => $request->expdate,
        ]);

        return redirect()->route('medicines.index');
    }
    
    public function edit(Medicine $medicine)
    {
        return Inertia::render('Medicines/Edit', ['medicine' => $medicine]);  
    }

    

    

}
