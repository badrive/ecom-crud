<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
        @vite(['resources/js/app.js'])
        @vite(['resources/css/app.css'])

    <!-- Styles -->

    
</head>

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white">
    <h1 class="text-4xl text-white font-bold">Dashboard</h1>

    <h3>image :</h3>
    <div>
       <button class="bg-white text-purple-500 font-bold p-1 rounded-lg" id="btnurl">url img</button>

       <button class="bg-white text-purple-500 font-bold p-1 rounded-lg d-none" id="btnfile">file img</button>

    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <br><br>

            <input id="imgfile" type="file" name="image">
            <input class="d-none" id="imgurl" type="text" name="link" placeholder="url image">
            
        </div>

        <br><br>
        <h3>product infos :</h3>
        <input class="text-black outline-none rounded-lg p-1 " name="name" type="text" placeholder="Name">
        <input class="text-black outline-none rounded-lg p-1 " name="type" type="text" placeholder="Type">
        <input class="text-black outline-none rounded-lg p-1 " name="taille" type="text" placeholder="Taille">
        <input class="text-black outline-none rounded-lg p-1 " name="stock" type="number" placeholder="Stock">
        <input class="text-black outline-none rounded-lg p-1 " name="price" type="number" placeholder="Price">
        <div>
            <label for="">available
                <input name="availability" type="radio">
            </label>

            <label for="">Out of stock
                <input name="availability" type="radio">
            </label>
        </div>

        <select name="cart_id" id="">
            <option selected disabled class="text-black " value="">Choose card</option>
            @foreach ($carts as $cart)
                <option class="text-black  " value="{{ $cart->id }}">{{ $cart->name }}</option>
            @endforeach
        </select>

        <button class="bg-white text-purple-500 font-bold p-1 rounded-lg">Add product</button>
    </form>

    <hr>
    <hr>
    <h1 class="text-4xl text-white font-bold">products</h1>


    <table>
        <tr>
            <th>image</th>
            <th>name</th>
            <th>type</th>
            <th>taille</th>
            <th>stock</th>
            <th>availability</th>
            <th>price</th>
            <th>edite</th>
            <th>delete</th>
        </tr>
        <hr>

        @foreach ($products as $product)
            <tr>
                <td><img width="100" src="{{ asset('storage/img/' . $product->image) }}" alt=""></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->type }}</td
                <td>{{ $product->taille }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->availability }}</td>
                <td>{{ $product->price }}</td>
                <td><a class="bg-white text-purple-500 font-bold p-1 rounded-lg" href="{{ route('product.show', $product) }}">Edite</a></td>
                <td>
                    <form action="{{ route('product.delete', $product) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button class="bg-white text-purple-500 font-bold p-1 rounded-lg">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>

<hr><hr>

    <h1>My Cart</h1>
<hr>

<form action="{{ route('cart.store') }}" method="post">
    @csrf
    <label for="">Add cart </label>
    <input class="text-black outline-none rounded-lg p-1 " name="name" type="text" placeholder="Add cart">
    <button class="bg-white text-purple-500 font-bold p-1 rounded-lg" type="submit">Submit</button>
</form>

@foreach ($products as $product)
        <h1> the product {{ $product->name }} buyed by {{ $product->cart->name}}</h1>
@endforeach

{{-- <form action="{{ route('product.store') }}" method="post">
    @csrf
    
    <select name="cart_id" id="">
        <option selected disabled value="">Choose product</option>
        @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>


    <select name="cart_id" id="">
        <option selected disabled value="">Choose card</option>
        @foreach ($carts as $cart)
            <option value="{{ $cart->id }}">{{ $cart->name }}</option>
        @endforeach
    </select>
    <button type="submit">Submit</button>
</form> --}}



</body>

</html>
