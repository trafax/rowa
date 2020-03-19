<h4>Navigatie</h4>
<ul class="list-group">
    <li class="list-group-item"><a href="{{ route('user.profile') }}">Mijn gegevens</a></li>
    <li class="list-group-item"><a href="{{ route('user.orders') }}">Mijn bestellingen</a></li>

    @if (Auth::user()->stock->count() > 0)
        <li class="list-group-item"><a href="{{ route('user.stock') }}">Mijn voorraad</a></li>
    @endif

    @if (Auth::user()->products->count() > 0)
        <li class="list-group-item"><a href="{{ route('user.products') }}">Mijn producten</a></li>
    @endif
</ul>
