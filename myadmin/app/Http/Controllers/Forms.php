<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forms as FormsModel;

class Forms extends Controller
{
    public function index(){
        return view('pages/forms');
    }

    public function save(Request $request){
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Process the validated data (e.g., save to database, send email, etc.)
        $form = FormsModel::create([
            'name' =>$request->input('name'),
            'first_name' => $request->input('first_name', null), // Optional field
            'last_name' => $request->input('last_name', null), // Optional field
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), // Hash the password
        ]);

        /**
         * name, image, description, price, sku, barcode, qty
         * 
         */
        
        // Flash success message to session
        return redirect()->route("forms")->with('success', 'Form submitted successfully!');
    }
}
