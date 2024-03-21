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
            "image" => "nullable|mimes:png,jpg,webp,url|max:2048",
            "link" => "nullable|url",
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
        
        // dd($request);
        

        // $uploadedFile = $request->file("image");
   
        // $product->update([
        //     "image"=> $imageName,
        //     "name"=> $request->name,
        //     "type"=> $request->type,
        //     "taille"=> $request->taille,
        //     "stock"=> $request->stock,
        //     "availability"=> $availability,
        //     "price"=> $request->price,
            
        // ]);
        
        // $uploadedFile->move("storage/img", $product->image);

        if ($request->has("image")) {
                        
            $image = $request->file("image");
            $imageName = time() . "_" . $image->getClientOriginalName();
            $image->storeAs("public/img", $imageName); 

            $uploadedFile = $request->file("image");
   
            $product->update([
                "image"=> $imageName,
                "name"=> $request->name,
                "type"=> $request->type,
                "taille"=> $request->taille,
                "stock"=> $request->stock,
                "availability"=> $availability,
                "price"=> $request->price,
                
            ]);

            $uploadedFile->move("storage/img", $product->image);

        } else if ($request->filled("link")) {

            $imagelink = file_get_contents($request->link);
            $extension = pathinfo($request->link, PATHINFO_EXTENSION);
            $filename = uniqid() . "." . $extension;
            Storage::put("public/img/" . $filename, $imagelink);

            $uploadedFile = $request->file("image");
   
            $product->update([
            "image" => $filename,
            "name"=> $request->name,
            "type"=> $request->type,
            "taille"=> $request->taille,
            "stock"=> $request->stock,
            "availability"=> $availability,
            "price"=> $request->price,
            ]);

    
        }

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


// we validate  our request  with customized conditions

        request()->validate([
            "image" => "nullable|mimes:png,jpg,webp,url|max:2048",
            "link" => "nullable|url",
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

        //& image

            if ($request->has("image")) {
                        
                $image = $request->file("image");
                $imageName = time() . "_" . $image->getClientOriginalName();
                $image->storeAs("public/img", $imageName); 

                Product::create([
                    "image"=> $imageName,
                    "name"=> $request->name,
                    "type"=> $request->type,
                    "taille"=> $request->taille,
                    "stock"=> $request->stock,
                    "availability"=> $availability,
                    "price"=> $request->price,
        
                ]);

            } else if ($request->filled("link")) {

                $imagelink = file_get_contents($request->link);
                $extension = pathinfo($request->link, PATHINFO_EXTENSION);
                $filename = uniqid() . "." . $extension;
                Storage::put("public/img/" . $filename, $imagelink);
                Product::create([
                "image" => $filename,
                "name"=> $request->name,
                "type"=> $request->type,
                "taille"=> $request->taille,
                "stock"=> $request->stock,
                "availability"=> $availability,
                "price"=> $request->price,
            ]);

           
        }

        //&image


        
// we redirect the user to specefic page 

        return redirect()->back();

    }

}