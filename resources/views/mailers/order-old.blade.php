<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Olá!</h1>
    <p>Enviamos a você os dados de sua compra realizada em Annette's.</p>
    <table>
        <thead>
            <tr>
            <th>Produto</th>
            <th>Preço</th>
        </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->pricing}}</td>
                </tr>
            @endforeach
                <tr>
                    <td>Total</td>
                    <td>{{$order->total}}</td>
                </tr>
        </tbody>
    </table>
</body>
</html>
