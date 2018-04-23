@extends('layouts.app')
@section("content")
    <header class="big-padding text-center blue-grey white-text">
        <h1>Compra completada</h1>
    </header>
    <div class="container">
        <div class="card large-padding">
            <h3>O pagamento foi efetuado <span class="{{$order->status}}">{{$order->status}}</span></h3>
            <p>Verifique os detalhes de sua compra:</p>
            <div class="row large-padding">
                <div class="col-xs-6">Email</div>
                <div class="col-xs-6">{{$order->email}}</div>
            </div>
            <div class="row large-padding">
                <div class="col-xs-6">Endereço</div>
                <div class="col-xs-6">{{$order->address()}}</div>
            </div>
            <div class="row large-padding">
                <div class="col-xs-6">CEP</div>
                <div class="col-xs-6">{{$order->postal_code}}</div>
            </div>
            <div class="row large-padding">
                <div class="col-xs-6">Cidade</div>
                <div class="col-xs-6">{{$order->city}}</div>
            </div>
            <div class="row large-padding">
                <div class="col-xs-6">Estado e País</div>
                <div class="col-xs-6">{{"$order->state $order->county_code"}}</div>
            </div>
            <div class="text-center top-space"><a href="{{url('/compras/'.$shopping_cart->customid)}}">Link da compra</a></div>
        </div>
    </div>
@endsection
