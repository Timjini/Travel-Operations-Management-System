<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Proforma Invoice</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            color: #332d29;
            margin: 0;
            padding: 30px;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            width: 100%;
            margin-bottom: 30px;
            border-bottom: 1px solid #dcd6cd;
            padding-bottom: 15px;
        }
        .logo_image {
            max-height: 60px;
        }
        .tagline {
            font-family: sans-serif;
            font-size: 8px;
            color: #8c6d46;
            letter-spacing: 2px;
            margin-top: 5px;
        }
        .title {
            font-size: 22px;
            color: #8c6d46;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: right;
        }
        .details-box {
            width: 100%;
            margin-bottom: 25px;
            background-color: #fbf9f5;
            border-left: 3px solid #8c6d46;
            padding: 12px;
            font-family: sans-serif;
            font-size: 11px;
        }
        .address-grid {
            width: 100%;
            margin-bottom: 30px;
        }
        .address-grid td {
            width: 50%;
            vertical-align: top;
        }
        .section-label {
            font-family: sans-serif;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #8c6d46;
            font-weight: bold;
            margin-bottom: 5px;
        }
        table.items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-family: sans-serif;
        }
        table.items-table th {
            background-color: #f4f0ea;
            color: #4a423b;
            padding: 8px;
            font-size: 10px;
            text-transform: uppercase;
            text-align: left;
        }
        table.items-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #eee8df;
            font-size: 11px;
        }
        .total-box {
            background-color: #fbf9f5;
            padding: 15px;
            border: 1px solid #eae3d9;
            font-family: sans-serif;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #8c7f73;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    @php 
        $companySetting = Auth::user()->company->setting ?? null; 
        $company = Auth::user()->company ?? null; 
        $customer = $proforma->file->customer ?? null; 
    @endphp

    <table class="header">
        <tr>
            <td style="vertical-align: top;">
                <img src="{{ public_path('images/emotions-morocco-logo.webp') }}" class="logo_image" />
            </td>
            <td style="vertical-align: top;" class="title">
                Proforma Invoice
                <div style="font-size: 11px; font-family: sans-serif; color: #554e48; margin-top: 5px;">
                    <strong>Proforma N°:</strong> {{$proforma->proforma_number}}<br>
                </div>
            </td>
        </tr>
    </table>

    <table class="details-box">
        <tr>
            <td><strong>File Ref:</strong> {{ $proforma->file->reference ?? 'N/A'}}</td>
            <td><strong>Destination:</strong> {{ $proforma->file->destination->name ?? 'N/A' }}</td>
            <td><strong>Date:</strong> {{ $proforma->file->start_date ? \Carbon\Carbon::parse($proforma->file->start_date)->format('d/m/Y') : 'N/A' }}</td>
            <td><strong>Due Date:</strong> {{$proforma->due_date->format('d/m/Y')}}</td>
        </tr>
    </table>

    <table class="address-grid">
        <tr>
            <td>
                <div class="section-label">Supplier Information</div>
                <strong>{{ $company->legal_name }}</strong><br>
                {{ $company->address }}<br>
                {{ $company->post_code }} {{ $company->city }}, {{ $company->country }}<br>
                <span style="font-size: 11px; color: #666;">VAT: {{ $company->vat_number }}</span>
            </td>
            <td>
                <div class="section-label">Billed To</div>
                <strong>{{ $proforma->file->customer->name ?? 'CLIENT NAME' }}</strong><br>
                {{ $proforma->file->customer->address }}<br>
                {{ $proforma->file->customer->post_code }} {{ $proforma->file->customer->city }}, {{ $proforma->file->customer->country }}<br>
                <span style="font-size: 11px; color: #666;">VAT: {{ $proforma->file->customer->vat_number }}</span>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 10%;">Tax</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 10%; text-align: center;">Qty</th>
                <th style="width: 15%; text-align: right;">Unit Price</th>
                <th style="width: 15%; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proforma->file->items as $item)
            <tr>
                <td>{{ $proforma->tax_rate ?? '-' }}</td>
                <td>{{ $item->service_name ?? 'N/A' }}</td>
                <td style="text-align: center;">{{ $item->quantity ?? '0' }}</td>
                <td style="text-align: right;">{{ number_format($item->unit_price, 2) }}</td>
                <td style="text-align: right;">{{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width: 100%;">
        <tr>
            <td style="width: 50%; vertical-align: top; font-family: sans-serif; font-size: 11px;">
                <div class="section-label">Payment Terms & Bank Details</div>
                Payment Terms: 30 Days<br>
                Bank: {{$company->setting->bank_name}}<br>
                IBAN: {{$company->setting->iban}}<br>
                SWIFT: {{$company->setting->swift_code}}
            </td>
            <td style="width: 50%; vertical-align: top;">
                <div class="total-box">
                    <table style="width: 100%; font-size: 12px;">
                        <tr>
                            <td>Subtotal:</td>
                            <td style="text-align: right;">{{ number_format($proforma->file->items->sum('total_price'), 2) }} {{ $proforma->currency->code }}</td>
                        </tr>
                        <tr>
                            <td>Tax (0%):</td>
                            <td style="text-align: right;">0.00 {{ $proforma->currency->code }}</td>
                        </tr>
                        <tr style="font-weight: bold; font-size: 14px; color: #8c6d46;">
                            <td style="padding-top: 8px;">Total Due:</td>
                            <td style="padding-top: 8px; text-align: right;">{{ number_format($proforma->total_amount, 2) }} {{ $proforma->currency->code }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        {{$company->name ?? ''}} &bull; {{$company->address}} &bull; VAT: {{$company->vat_number}}
    </div>
</body>
</html>