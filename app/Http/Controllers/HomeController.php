<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //


    public function index()
    {
        // * select  all products
        $products =  Product::all();

        return view("home", compact("products"));
    }

    //!update page

    public function show(Product $product)
    {
        return view("components.edite", compact("product"));
    }

    public function update(Request $request, Product $product)
    {
        request()->validate([
            "name" => "required",
            "price" => "required",
            "type" => "required",
            "stock" => "required",
        ]);
        $product->update([
            "name" => $request->name,
            "price" => $request->price,
            "type" => $request->type,
            "stock" => $request->stock,
        ]);
        return back();
    }

    //!

    public function store(Request $request)
    {

        //& image 

        $image = $request->file("image");
        $imageName = time() . "_" . $image->getClientOriginalName();
        $image->storeAs("public/img", $imageName); 

        //&image

// we validate  our request  with customized conditions

        request()->validate([
            "image" => "required|mimes:png,jpg,webp|max:2048",
            "type" => "required",
            "taille" => "required",
            "stock" => "required",
            "availability" => "required",
            "price" => "required"
        ]);

        $availability = false;
        if ($request->availability == "true") {
            $availability = true;
        };
// we create  a row  in  our database
// we call our model

        Product::create([
            "image"=> $imageName,
            "name"=> $request->name,
            "type"=> $request->type,
            "taille"=> $request->taille,
            "stock"=> $request->stock,
            "availability"=> $availability,
            "price"=> $request->price,

        ]);

        
// we redirect the user to specefic page 

        return redirect()->back();

    }

}