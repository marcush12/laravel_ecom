{!! Form::open(['url' => $url, 'method' => $method,  'files' => true]) !!}
            <div class="form-group">{{ Form::text('title', $product->title, ['class' => 'form-control', 'placeholder' => 'Nome...']) }}</div>
            <div class="form-group">{{ Form::number('pricing', $product->pricing, ['class' => 'form-control', 'placeholder' => 'Preço do produto...']) }}</div>
            <div class="form-group">
                {{Form::file('cover')}}
            </div>
            <div class="form-group">{{ Form::textarea('description', $product->description, ['class' => 'form-control', 'placeholder' => 'Descrição...']) }}</div>
            <div class="form-group text-right">
                <a href="{{ '/products' }}">Voltar</a>
                <input type="submit" value='Enviar' class="btn btn-success">
            </div>
        {!! Form::close() !!}
