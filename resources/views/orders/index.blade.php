@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Dashboard</h2>
            </div>
            <div class="panel-body">
                <h3>Estatísticas</h3>
                <div class="row top-space">
                    <div class="col-xs-4 col-md-3 col-lg-2 sale-data">
                        <span>R$ {{$totalMonth}}</span>
                        Entradas do mês
                    </div>
                    <div class="col-xs-4 col-md-3 col-lg-2 sale-data">
                        <span>{{$totalMonthCount}}</span>
                        Número de vendas no mês
                    </div>
                </div>
                <h3>Vendas</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID venda</td>
                            <td>Comprador</td>
                            <td>Endereço</td>
                            <td>Número guia</td>
                            <td>Status</td>
                            <td>Data da venda</td>
                            <td>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->recipient_name}}</td>
                                <td>{{$order->address()}}</td>
                                <td><a href="#" data-type='text'
                                                data-pk="{{$order->id}}"
                                                data-url="{{url('/orders/$order->id')}}"
                                                data-title="Número da guia"
                                                data-value="{{$order->guide_number}}"
                                                class="set-guide-number"
                                                data-name="guide_number">
                                    </a>
                                </td>
                                <td><a href="#" data-type='select'
                                                data-pk="{{$order->id}}"
                                                data-url="{{url('/orders/$order->id')}}"
                                                data-title="Número da guia"
                                                data-value="{{$order->status}}"
                                                class="select-status"
                                                data-name="status">
                                    </a>
                                </td>
                                <td>{{$order->created_at}}</td>
                                <td>Ações</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
