<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Proforma Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        /* Header Layout */
        .header-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            position: relative;
        }

        .logo_image {
            height: 60px;
            width: auto;
        }

        .client-address {
            font-size: 12px;
            text-align: right;
            text-transform: uppercase;
        }

        .proforma-title {
            margin-bottom: 40px;
            font-weight: bold;
        }
        
        .header {
            margin-bottom: 30px;
        }

        .logo_image {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            height: 50px;
            width: auto;
        }

        .company-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .address {
            position: absolute;
            line-height: 1.4;
            margin-bottom: 30px;
            right: 20px;
            top: 150px;
        }

        .invoice-number {
            font-weight: bold;
            margin-bottom: 30px;
        }

       /* Tables Styling */
        table {
            font-size: 12px;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2; /* Light grey header */
            color: #333;
            font-weight: normal;
            padding: 6px 8px;
            border: 1px solid #ccc;
        }

        td {
            padding: 8px;
            border: 1px solid #ccc;
            vertical-align: top;
        }

        .payment-details {
            margin-bottom: 30px;
            border: 1px solid #c0c0c0;
            padding: 5px;
        }

        .payment-details p {
            margin: 5px 0;
        }

        .totals {
            width: 250px;
            padding: 5px;
            margin-bottom: 30px;
        }

        .payment-container {
            width: 100%;
            margin-bottom: 20px;
        }

        .payment-details,
        .totals {
            display: inline-block;
            vertical-align: top;
        }

        .payment-details {
            width: 50%;
        }

        .totals {
            padding-left: 50px;
            width: 38%;
        }

        .total-container {
            width: 100%;
            padding: 5px 0;
        }

        .total-container p {
            display: inline-block;
            width: 48%;
            margin: 0;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
        }
        
        
        .main-info-container {
        width: 100%;
    }
    .info-box {
        width: 48%; 
        vertical-align: top;
        display: inline-block; 
    }
    .info-table {
        width: 100%;
        border-spacing: 0;
        margin-top: 10px;
    }
    .info-table td {
        vertical-align: top;
        padding-bottom: 8px;
        font-size: 12px;
    }
    .label {
        font-weight: bold;
        width: 80px;
    }
    .section-header {
        font-weight: bold;
        border-bottom: 1px solid #000;
        display: block;
        margin-bottom: 5px;
    }
    
    .section-title table , th, td{
        border: none;
    }
    .inner-info-table table , th, td{
        border: none;
    }
    </style>
</head>

<body>
    @php $companySetting = Auth::user()->company->setting ?? null; $company
    = Auth::user()->company ?? null; $customer = $invoice->file->customer ??
    null; @endphp
    <div class="header-container">
        <div class="logo">
            <img src="{{ public_path('images/emotions-morocco-logo.webp') }}" class="logo_image" />
            <div style="font-size: 10px; color: #0088cc; font-weight: bold;">DESTINATION MANAGEMENT COMPANY</div>
        </div>
    <table class="invoice-header-table" style="border: none;">
    <tr >
        <!-- Left Column: Supplier -->
        <td style="padding-right: 20px;border: none;">
            <div class="section-title">Supplier Information</div>
            <table class="inner-info-table" syle="boder:none;">
                <tr>
                    <td class="label">Name:</td>
                    <td>{{ $company->legal_name }}</td>
                </tr>
                <tr>
                    <td class="label">Address:</td>
                    <td>
                        {{ $company->address }}<br/>
                        {{ $company->post_code }} {{ $company->city }}<br/>
                        {{ $company->country }}
                    </td>
                </tr>
                <tr>
                    <td class="label">VAT No:</td>
                    <td>{{ $company->vat_number }}</td>
                </tr>
            </table>
        </td>

        <!-- Right Column: Billed To -->
        <td style="padding-left: 20px;">
            <div class="section-title">Billed To</div>
            <table class="inner-info-table" >
                <tr >
                    <td class="label" >Client:</td>
                    <td>{{ $invoice->file->customer->name ?? 'CLIENT NAME' }}</td>
                </tr>
                <tr>
                    <td class="label">Address:</td>
                    <td>
                        {{ $invoice->file->customer->address }}<br/>
                        {{ $invoice->file->customer->post_code }} {{ $invoice->file->customer->city }}<br/>
                        {{ $invoice->file->customer->country }}
                    </td>
                </tr>
                <tr>
                    <td class="label">VAT No:</td>
                    <td>{{ $invoice->file->customer->vat_number }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
    </div>
    

    <div>
        <span style="font-size:12px"> Proforma n°: {{$invoice->proforma->proforma_number}} </span><br/>
        <span style="font-size:12px"> Invoice n°: {{$invoice->invoice_number}} </span><br/>
        <span style="font-size:10px">Due Date: {{$invoice->due_date->format('d/m/Y')}}</span><br/>
        <span style="font-size:10px">Payment Terms (Days) : 30</span>
    </div>
<table class="details">
    <tr>
        <th>File</th>
        <th>Reference</th>
        <th>Service</th>
        <th>Requested by</th>
    </tr>
    <tr>
        <td>{{ $invoice->file->reference ?? 'NAN'}}</td>
        <td>{{ $invoice->file->destination->name ?? '' }}</td>
        <td>{{ $invoice->file->start_date ? \Carbon\Carbon::parse($invoice->file->start_date)->format('d/m/Y') : '' }}</td>
        <td>{{ $invoice->owner->name ?? ''}}</td>
    </tr>
</table>

<table class="items-table">
        <thead>
            <tr>
                <th style="width: 10%;">Tax</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 10%;">Qty</th>
                <th style="width: 15%;">Amount</th>
                <th style="width: 15%;">Total</th>
            </tr>
        </thead>
        <tbody style="min-height: 300px;">
            @foreach ($invoice->items as $item)
            <tr>
                <td>{{ $invoice->tax_rate ?? '-' }}</td>
                <td>{{ $item->service_name ?? 'NAN' }}</td>
                <td style="text-align: center;">{{ $item->quantity ?? 'NAN' }}</td>
                <td style="text-align: right;">{{ number_format($item->unit_price, 2) }}</td>
                <td style="text-align: right;">{{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td style="height: 250px;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="payment-container" style="font-size:12px">
        <div class="payment-details">
            <p><strong>Payment Details</strong></p>
            <p>Bank: {{$company->setting->bank_name}}</p>
            <p>Iban: {{$company->setting->iban}}</p>
            <p>Swift: {{$company->setting->swift_code}}</p>
        </div>

        <div class="totals">
        <div>
            <strong class="label">Subtotal:</strong>
            <span class="text-right">{{ number_format($invoice->items->sum('total_price'), 2) }} {{ $invoice->currency->code }}</span>
    </div>
        <div>
            <strong class="label">Tax (0%):</strong>
            <span class="text-right">0.00 {{ $invoice->currency->code }}</span>
    </div>
        <div>
            <strong class="label total-row">TOTAL DUE:</strong>
            <span class="text-right total-row">{{ number_format($invoice->total_amount, 2) }} {{ $invoice->currency->code }}</span>
    </div>
    </div>
    </div>
    <hr />
    <div class="footer" style="font-size:10px">
        <div class="total-container">
            <p>{{$company->name ?? ''}}</p>
        </div>

        <div class="total-container">
            <p>
                {{$company->address}}
            </p>
        </div>
        <div class="total-container">
            <p><span>Email</span>{{$company->email}} - <span>Vat Number:</span> {{$company->vat_number}}</p>
        </div>
    </div>
</body>

</html>