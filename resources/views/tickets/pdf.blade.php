<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota #{{ $sale->id }}</title>
    <style type="text/css">
        html,
        body {
            margin: 0%;
            margin-right: 4pt;
            margin-left: 4pt;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .bg-sky-500 {
            --tw-bg-opacity: 1;
            background-color: rgb(14 165 233 / var(--tw-bg-opacity))
                /* #0ea5e9 */
            ;
        }

        table {
            border-collapse: collapse !important;
            border-spacing: 0 !important;
            display: table;
            width: 100%;
        }

        .text-sky-500 {
            --tw-text-opacity: 1;
            color: rgb(14 165 233 / var(--tw-text-opacity))
                /* #0ea5e9 */
            ;
        }

        *,
        ::before,
        ::after {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: currentColor;
        }

        table::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e2e8f0;
        }

        table::after {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e2e8f0;
        }

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .border-gray-400 {
            border-color: #cbd5e0;
        }

        .bg-gray-400 {
            background-color: #cbd5e0;
        }

        .text-center {
            text-align: center;
        }

        .text-xl {
            font-size: 18px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-sm {
            font-size: 0.7em;
        }

        .text-justify {
            text-align: justify;
        }

        .text-xs {
            font-size: 0.5em;
        }

        .mt-2 {
            margin-top: 2em;
        }

        .mt-1 {
            margin-top: 1em;
        }

        .mt-0 {
            margin-top: 0px;
        }

        .m-0 {
            margin: 0%;
        }

        .mb-0 {
            margin-bottom: 0px !important;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }

        .mb-2 {
            margin-bottom: .5rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .border {
            border-width: 1px;
        }

        .border-b {
            border-bottom-width: 1px;
        }

        .border-solid {
            border-style: solid;
        }

        .border-t {
            border-top-width: 1px;
        }

        .border-black {
            border-color: black;
        }

        .bg-blue-700 {
            background-color: #2529BD;
        }

        .font-bold {
            font-weight: 700;
        }

        .p-1 {
            padding: 0.25rem;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .p-3 {
            padding: 0.75rem;
        }

        .p-4 {
            padding: 1rem;
        }

        .py-0 {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .py-1 {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .text-xl {
            font-size: 1.5em;
        }

        .rounded {
            border-radius: 0.25rem;
        }

        .table-auto {
            table-layout: auto;
        }

        .px-2 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .hr-double {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;

        }
    </style>
    <script type="text/javascript">
        document.querySelector('#fecha').style.background = 'blue';
    </script>
</head>

<body>
    <table style="width:100%; margin-top: 8px;">
        <tr>
            <td style="width:150px; vertical-align:top;">
                <img src="{{ asset('images/logo.png') }}" style="width:200px; height:auto;">
            </td>

            <td style="text-align:center; vertical-align:top;">
                <div class="">
                    {{ $ticketConfig->company }}
                </div>
                <div>ICO080107337</div>
            </td>
        </tr>
    </table>

    <div class="p-1">
        <div class="border-b border-t py-2">
            <div id="fecha" class="text-sm">
                {{ $ticketConfig->address }} Col. Centro C.P. {{ $ticketConfig->postal_code }} {{ $ticketConfig->city }}
            </div>
            <div class="text-sm">
                <span>Tel: {{ $ticketConfig->phone_number }}</span> <span style="float: right;">Whatsapp:
                    {{ $ticketConfig->whatsapp }}</span>
            </div>
            <div class="clearfix text-sm font-bold" style="margin-top:4px;">
                <div class="float-left w-50" style="text-align:left;">
                    <span style="color:#0ea5e9; font-weight:bold;margin-right: .5rem">Fecha:</span> {{ $now }}
                </div>
                <div class="float-right w-50" style="text-align:right;">
                    <span style="color:#0ea5e9; font-weight:bold;margin-right: .5rem">NOTA:</span> {{ $sale->id }}
                </div>
            </div>
        </div>
        <div class="text-sm" style="margin-top:.3rem">
            <span class="font-bold">Cliente: </span> {{ $customerName }}
        </div>

        <table class="mt-1 mb-0 table-auto text-center rounded text-sm">
            <thead>
                <tr class="bg-gray-400 px-2">
                    <th>Cant.</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($products as $product)
                    <tr class="text-md">
                        <td class="border-b border-gray-400 py-1">
                            {{ $product->pivot->qty }}
                        </td>
                        <td class="border-b border-gray-400 py-1">
                            {{ $product->description }}
                        </td>
                        <td>
                            {{ $product->pivot->sale_price }}
                        </td>
                        <td class="border-b border-gray-400 py-1">
                            {{ $product->pivot->qty * $product->pivot->sale_price }}
                        </td>
                    </tr>
                    @php
                        $total += $product->pivot->qty * $product->pivot->sale_price;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="2" class="bg-gray-400"> TOTAL</td>
                    <td colspan="2" class="font-bold">
                        $
                        {{ number_format($total, 2) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-0 mb-0">
            <p style="white-space: pre-line;line-height: 35px" class=" p-2">
                {{ $ticketConfig->footer }}
            </p>
        </div>
    </div>
</body>

</html>
