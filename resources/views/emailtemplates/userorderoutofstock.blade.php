@foreach ($order['out_of_stock'] as $product)
    - {{ $product->title }}<br>
@endforeach
