@extends('layouts.app')
@section('title','Annette\'s Store')

@section('content')
    <div class="container text-center products-container">
        @foreach($products as $product)
            @include("products.product", ["product"=>$product])
        @endforeach
        <div>
            {{$products->links()}}
        </div>
    </div>
@endsection
