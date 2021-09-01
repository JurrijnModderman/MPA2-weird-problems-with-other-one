<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
      
    <title>MPA</title>
</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="{{route('home')}}">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <li class="logout"><a href="{{ url('/logout') }}" class="menu-btn">Logout</a></li>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          User
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('login')}}">Login</a>
          <a class="dropdown-item" href="{{route('register')}}">Register</a>
          @csrf
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('product.cart')}}">Shopping Cart
        <span>{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
@if(Session::has('success'))
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
      <div id="charge-message" class="alert alert-success">
        {{Session::get('success')}}
      </div>
    </div>
  </div>
  @endif
@foreach(App\Models\Product::all() as $product)
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src='{{$product->image}}' alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{$product->title}}</h5>
    <p class="card-text">{{$product->description}}</p>
    <p class="card-text">€{{$product->price}}-,</p>
    <a href="{{ route('addToCart', ['id' => $product->id]) }}" class="btn btn-primary">Add to cart</a>
  </div>
</div>
</div>
@endforeach
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>