<table width="100%">
    <tr>
        <td width="50%">
            <table width="100%">
                <tr>
                    <td><strong>Bedrijfsnaam:</strong></td>
                    <td>{{ $order['user']->company_name }}</td>
                </tr>
                <tr>
                    <td><strong>Naam:</strong></td>
                    <td>{{ $order['user']->firstname }} {{ $order['user']->preposition }} {{ $order['user']->lastname }}</td>
                </tr>
                <tr>
                    <td><strong>Adres:</strong></td>
                    <td>{{ $order['user']->street }} {{ $order['user']->house_number }}</td>
                </tr>
                <tr>
                    <td><strong>Postcode + woonplaats:</strong></td>
                    <td>{{ $order['user']->zipcode }} {{ $order['user']->city }}</td>
                </tr>
                <tr>
                    <td><strong>Telefoonnummer:</strong></td>
                    <td>{{ $order['user']->telephone }}</td>
                </tr>
                <tr>
                    <td><strong>E-mailadres:</strong></td>
                    <td>{{ $order['user']->email }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<hr>

<table width="50%">
    <tr>
        <td><strong>Datum:</strong></td><td>{{ date('d-m-Y') }}</td>
    </tr>
</table>

<hr>

<table width="100%">
    <tr>
        <th style="text-align: left;">Product</th>
        <th style="text-align: left;">Op voorraad</th>
        <th style="text-align: left;">Collie</th>
        <th style="text-align: left;">Besteld</th>
    </tr>
    @foreach ($order['rules'] as $rule)
        <tr>
            <td>{{ $rule['product']->title }}</td>
            <td>{{ $rule['product']->qty }}</td>
            <td>{{ $rule['product']->collie }}</td>
            <td>{{ $rule['qty'] }}</td>
        </tr>
    @endforeach
</table>
