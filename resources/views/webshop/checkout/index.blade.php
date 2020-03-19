@extends('layouts.website')

@section('content')
    <div class="main container">
        <div class="top">
            <div class="breadcrumbs">
                <a href="/">Home</a> / Besteloverzicht / Afrekenen
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-warning mb-4">
                @foreach ($errors->all() as $error)
                    {{ ucfirst($error) }}
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('order.create') }}">
            <div class="row checkout">
                @csrf
                <div class="col-md-4">
                    <h3>1. Vul je gegevens in</h3>
                    <span>Jouw gegevens:</span>
                    @if (Auth::user()->company_name)
                        <div class="form-group mt-3">
                            <label class="font-weight-bold">Bedrijfsnaam</label>
                            <div>{{ Auth::user()->company_name }}</div>
                        </div>
                    @endif
                    <div class="form-group mt-3">
                        <label class="font-weight-bold">Naam</label>
                        <div>{{ Auth::user()->firstname }} {{ Auth::user()->preposition }} {{ Auth::user()->lastname }}</div>
                    </div>
                    <div class="form-group mt-3">
                        <label class="font-weight-bold">Adres</label>
                        <div>{{ Auth::user()->street }} {{ Auth::user()->house_number }}</div>
                    </div>
                    <div class="form-group mt-3">
                        <label class="font-weight-bold">Postcode + woonplaats</label>
                        <div>{{ Auth::user()->zipcode }} {{ Auth::user()->city }}</div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">E-mailadres</label>
                        <div>{{ Auth::user()->email }}</div>
                    </div>
                    <hr>
                    <script>
                    $(function(){
                        $('[name="other_delivery"]').on('click', function(){
                            $('.other_delivery').slideToggle();
                        });
                    });
                    </script>
                    <div class="form-group mb-0">
                        <label>
                            <input type="checkbox" name="other_delivery" value="1">
                            Afleveren op een andres adres
                        </label>
                    </div>
                    <div class="my-3 other_delivery">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Straatnaam</label>
                                    <input type="text" name="delivery_street" class="form-control" value="{{ Auth::user()->delivery_street }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Huisnummer</label>
                                    <input type="text" name="delivery_house_number" class="form-control" value="{{ Auth::user()->delivery_house_number }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Postcode</label>
                                    <input type="text" name="delivery_zipcode" class="form-control" value="{{ Auth::user()->delivery_zipcode }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Woonplaats</label>
                                    <input type="text" name="delivery_city" class="form-control" value="{{ Auth::user()->delivery_city }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="privacy" value="1">
                            Ik heb het <a href="#">privacybeleid</a> gelezen en ga hiermee akkoord
                        </label>
                    </div>
                </div>

                <div class="col-md-4">
                    <h3>2. Kies een betaalmethode</h3>
                    <span>Kies gewenste betaalmethode:</span>
                    <div class="d-block">
                        @if (session()->get('cart.prices')['total'])
                            @foreach ($paymentMethods as $key => $paymentMethod)
                            <div class="my-1">
                                <label>
                                    <input type="radio" name="payment_method" value="{{ $paymentMethod->id }}" {{ $key == 0 ? 'checked' : '' }} class="mr-2">
                                    {{ htmlspecialchars($paymentMethod->description) }}
                                    <img src="{{ htmlspecialchars($paymentMethod->image->size1x) }}" srcset="{{ htmlspecialchars($paymentMethod->image->size2x) }} 2x" class="ml-2">
                                </label>
                            </div>
                            @endforeach
                        @endif
                        <div class="my-1">
                            <label>
                                <input type="radio" name="payment_method" value="op_rekening" class="mr-2">
                                Op rekening (voor klanten)
                            </label>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label class="font-weight-bold">Plaats eventuele opmerking</label>
                        <textarea class="form-control" rows="5" name="comment">{{ old('comment', (session()->get('order')['comment'] ?? '')) }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <h3>3. Overzicht van je bestelling</h3>
                    <span class="d-block mb-3">Controleer jouw bestelling:</span>

                    @foreach (session()->get('cart')['items'] ?? [] as $key => $row)
                        <div class="border-bottom py-2">
                            <div class="row">
                                <div class="col">
                                    <label class="font-weight-bold mb-0">{{ $row['title'] }}</label>
                                    <div class="">
                                        @foreach ($row['options'] ?? [] as $optionTitle => $optionValue)
                                            <label class="text-secondary mb-0"><label class="font-weight-bold mb-0">{{ $optionTitle }}</label>: {{ $optionValue }}</label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col text-right">&euro; {{ price($row['price'] * $row['qty']) }}</div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4 py-1">
                        <div class="row font-weight-bold">
                            <div class="col text-right">Sub-totaal</div>
                            <div class="col-3 text-right">&euro; {{ price(session()->get('cart.prices')['total']) }}</div>
                        </div>
                    </div>
                    <div class="py-1">
                        <div class="row font-weight-bold">
                            <div class="col text-right">Verzendkosten</div>
                            <div class="col-3 text-right">&euro; {{ price(session()->get('cart.prices')['shipping']) }}</div>
                        </div>
                    </div>
                    <div class="py-1">
                        <div class="row font-weight-bold">
                            <div class="col text-right">Totaal</div>
                            <div class="col-3 text-right">&euro; {{ price(session()->get('cart.prices')['total']) }}</div>
                        </div>
                    </div>

                    <div class="my-4 text-right">
                        <button class="btn btn-primary">Plaats bestelling en ga door naar betalen</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
