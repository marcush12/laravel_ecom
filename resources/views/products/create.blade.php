@extends('layouts.app')
@section('content')
    <div class="container white">
        <h1>Novo Produto</h1>
        <!--form-->
        @include('products.form', ['product' => $product, 'url' => '/products', 'method' => 'POST'])
    </div>
@endsection

