<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageForm;

class ImageForms extends Controller
{
    public function index()
    {
        return view('pages/imageform');
    }

    public function save(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'sku' => 'required|unique:imageform,sku',
            'barcode' => 'required|unique:imageform,barcode',
            'qty' => 'required|integer|min:0',
        ]);
        

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
        }

        // Create new product record
        $form = ImageForm::create([
            'name' => $request->input('name'),
            'image' => $imageName ?? null,
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'sku' => $request->input('sku'),
            'barcode' => $request->input('barcode'),
            'qty' => $request->input('qty'),
        ]);

        // Redirect with success message
        return redirect()->route('imageform')->with('success', 'Product added successfully!');
    }
}