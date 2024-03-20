<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        
    </head>
    <body>
        <h1>Dashboard</h1>

        <form action="{{ route("product.store") }}" method="post" enctype="multipart/form-data">
            @csrf
            <h3>image :</h3>
            <div>
                <input type="file" name="image">
                <input type="text" placeholder="url image">
            </div>

            <br><br>
            <h3>product infos :</h3>
            <input name="name" type="text" placeholder="Name">
            <input name="type" type="text" placeholder="Type">
            <input name="taille" type="text" placeholder="Taille">
            <input name="stock" type="number" placeholder="Stock">
            <input name="price" type="number" placeholder="Price">
            <div>
                <label for="">available
                    <input name="availability" type="radio">
                </label>

                <label for="">Out of stock
                    <input name="availability" type="radio">
                </label>
            </div>

            <button>Add product</button>
        </form>

<hr>
<hr>
        <h1>products</h1>

        
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
            <td><img width="100" src="{{ asset("storage/img/" . $product->image) }}" alt=""></td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->type }}</td>
              <td>{{ $product->taille }}</td>
              <td>{{ $product->stock }}</td>
              <td>{{ $product->availability }}</td>
              <td>{{ $product->price }}</td>
              <td><a href="{{ route("product.show", $product) }}">Edite</a></td>
              <td><button>delete</button></td>
            </tr>
        @endforeach
            
        </table>

    </body>
</html>
