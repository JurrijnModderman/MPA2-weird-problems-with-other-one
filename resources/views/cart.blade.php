<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}"> -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    
    


    <title>Shopping Cart</title>
</head>
<body>

@if (Session::has('cart'))
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Quantity</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
        </tr>
        </thead>

        <tbody>
        <tr>
        @foreach($products as $product) 
                <th scope="row">{{ $product['qty'] }}</th>
                <td><strong>{{ $product['item']['title'] }}</strong></td>
                <td><span class="label label-succes">€{{ $product['price'] }}</span></td>
                <td>
                        <a class="dropdown-item"
                               href="{{ route('reduceByOne', ['id'=> $product['item']['id']]) }}">Reduce by 1</a>
                        <a class="dropdown-item"
                               href="{{ route('remove', ['id'=> $product['item']['id']]) }}">Reduce all</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <div class="row">
        <div class="col-sm6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <strong>Total: €{{ $totalPrice }}</strong>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm6 col-md-6 col-md-offset-3 col-sm-offset-3">
            
        </div>
    </div>
    <a type="button" href="{{ route('product.getShoppingCart', ['id'=> $product['item'] ['id']]) }}">Checkout</button>
@else
    <div class="row">
        <div class="col-sm6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <h3>There are no items in the Cart!</h3>
        </div>
    </div>
@endif

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

