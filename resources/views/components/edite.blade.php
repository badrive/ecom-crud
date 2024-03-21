<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js'])
    @vite(['resources/css/app.css'])
    <title>Document</title>
</head>
<body>
    
    <h1>You are now editing {{ $product->name }} </h1>

    <h3>image :</h3>
    <div>
       <button id="btnurl">url img</button>

       <button class="d-none" id="btnfile">file img</button>


    <form action="{{ route('product.update', $product) }}" on method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        
        <br><br>

        <input id="imgfile" type="file" name="image">
        <input class="d-none" id="imgurl" type="text" name="link" placeholder="url image">
    <br><br>
    </div>

        <input autofocus value="{{ old('name', $product->name) }}" name="name" type="text"
            placeholder="insert product name" required>

        <input value="{{ old('type', $product->type) }}" name="type" type="text" placeholder="insert product type"
            required>
        
            
            <input value="{{ old('price', $product->taille) }}" name="taille" type="text" placeholder="insert product taille"
            required> 
            
            <input value="{{ old('stock', $product->stock) }}" name="stock" type="number" placeholder="insert product stock"
            required>
            
            <input value="{{ old('price', $product->price) }}" name="price" type="number" placeholder="insert product price"
                required>

                <div>
                    <label for="">available
                        <input name="availability" type="radio" {{ $product->availability == "1" ? "checked" : "" }}>
                    </label>
        
                    <label for="">Out of stock
                        <input name="availability" type="radio" {{ $product->availability == "0" ? "checked" : "" }}>
                    </label>
                </div>
        
    <br><br>
        <button>Update</button>
    </form>


   


</body>
</html>