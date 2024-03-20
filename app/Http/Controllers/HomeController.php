<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Storage;

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
            "image" => "required|mimes:png,jpg|max:2048",
            "name" => "required",
            "price" => "required"
            
        ]);
        
        // dd($request);
        

        $uploadedFile = $request->file("image");
   
        $product->update([
            "name" => $request->name,
            "price" => $request->price,
            
        ]);
        
        $uploadedFile->move("storage/img", $product->image);

        return redirect()->route("product.index");
    }

    //!

    //? delete 

    public function destroy(Product $product)
    {
        Storage::disk("public")->delete("img/" . $product->image);
        $product->delete();
        return back();
    }


    //?

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