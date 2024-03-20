<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h1>You are now editing {{ $product->name }} </h1>


    <form action="{{ route('product.update', $product) }}" on method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        
        <input name="image" type="file">

        <input autofocus value="{{ old('name', $product->name) }}" name="name" type="text"
            placeholder="insert product title" required>

        <input value="{{ old('price', $product->price) }}" name="price" type="number" placeholder="insert product price"
            required>
        
        <button>Update</button>
    </form>


</body>
</html>