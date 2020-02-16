<table width="100%">
    <tr>
        <td width="50%">
            <table width="100%">
                <tr>
                    <td><strong>Bedrijfsnaam:</strong></td>
                    <td>{{ $order->user->company_name }}</td>
                </tr>
                <tr>
                    <td><strong>Naam:</strong></td>
                    <td>{{ $order->user->firstname }} {{ $order->user->preposition }} {{ $order->user->lastname }}</td>
                </tr>
                <tr>
                    <td><strong>Adres:</strong></td>
                    <td>{{ $order->user->street }} {{ $order->user->house_number }}</td>
                </tr>
                <tr>
                    <td><strong>Postcode + woonplaats:</strong></td>
                    <td>{{ $order->user->zipcode }} {{ $order->user->city }}</td>
                </tr>
                <tr>
                    <td><strong>Telefoonnummer:</strong></td>
                    <td>{{ $order->user->telephone }}</td>
                </tr>
                <tr>
                    <td><strong>E-mailadres:</strong></td>
                    <td>{{ $order->user->email }}</td>
                </tr>
            </table>
        </td>
        <td width="50%">
            @if ($order->user->other_delivery == 1)
                <table width="100%">
                    <tr>
                        <td colspan="2"><h3>Afleveradres</h3></td>
                    </tr>
                    <tr>
                        <td><strong>Adres:</strong></td>
                        <td>{{ $order->user->delivery_street }} {{ $order->user->delivery_house_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Postcode + woonplaats:</strong></td>
                        <td>{{ $order->user->delivery_zipcode }} {{ $order->user->delivery_city }}</td>
                    </tr>
                </table>
            @endif
        </td>
    </tr>
</table>

<hr>

<table width="50%">
    <tr>
        <td><strong>Datum:</strong></td><td>{{ $order->created_at->format('d-m-Y') }}</td>
    </tr>
    <tr>
        <td><strong>Factuurnummer:</strong></td><td>{{ $order->order_nr }}</td>
    </tr>
</table>

<hr>

<table width="100%">
    <tr>
        <th style="text-align: left;">Product</th>
        <th style="text-align: left;">Aantal</th>
        <th style="text-align: left;">Prijs</th>
    </tr>
    @foreach ($order->rules as $rule)
        <tr>
            <td>
                {{ $rule->product->title }}<br>
                @foreach ($rule->options ?? [] as $optionTitle => $optionValue)
                    <strong>{{ $optionTitle }}:</strong> {{ $optionValue }}
                @endforeach
            </td>
            <td>{{ $rule->qty }}x</td>
            <td>&euro; {{ price($rule->price * $rule->qty) }}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td>Subtotaal</td>
        <td>&euro; {{ price($order->price_sub_total) }}</td>
    </tr>
    <tr>
        <td></td>
        <td>Verzendkosten</td>
        <td>&euro; {{ price($order->price_shipping) }}</td>
    </tr>
    <tr>
        <td></td>
        <td>Totaal</td>
        <td>&euro; {{ price($order->price_total) }}</td>
    </tr>
</table>
