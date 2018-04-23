{!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST', 'class'=>'add-to-cart inline-block']) !!}
    <input type="hidden" name='product_id' value='{{$product->id}}'>
    <input type="submit" class="btn btn-info" value='Adicionar ao carrinho'>
{!! Form::close() !!}
