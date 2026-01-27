<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Proforma Invoice #{{  }}</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f9fafb;
        color: #111827;
        margin: 0;
        padding: 20px;
    }
    .container {
        max-width: 700px;
        margin: auto;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .header h2 {
        margin: 0;
        font-size: 18px;
    }
    .section {
        padding: 20px;
    }
    .section p {
        margin: 6px 0;
        font-size: 14px;
    }
    .badge {
        display: inline-block;
        padding: 4px 8px;
        font-size: 12px;
        border-radius: 6px;
    }
    .badge.draft { background: #f3f4f6; color: #374151; }
    .badge.sent { background: #dbeafe; color: #1e40af; }
    .badge.paid { background: #dcfce7; color: #166534; }
    .badge.overdue { background: #fee2e2; color: #991b1b; }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 16px;
    }
    table th, table td {
        border: 1px solid #e5e7eb;
        padding: 8px;
        text-align: left;
        font-size: 13px;
    }
    .footer {
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
        font-size: 12px;
        color: #6b7280;
        text-align: center;
    }
    .btn {
        display: inline-block;
        background: #2563eb;
        color: white;
        padding: 10px 16px;
        border-radius: 6px;
        font-size: 14px;
        text-decoration: none;
    }
    .btn:hover {
        background: #1e40af;
    }
</style>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>File #{{ $file->id }}</h2>
            <span class="badge {{ }}">
                {{ ucfirst($file->status) }}
            </span>
        </div>

        <div class="content" style="padding: 20px 0; line-height: 1.6; color: #333;">
            <p>Dear Team,</p>
            <p>This is a reminder regarding the processing of <strong>File #{{ $file->reference }}</strong>. The file is currently marked as <strong>{{ strtoupper($file->status) }}</strong> and requires your immediate attention to proceed to the next stage of the workflow.</p>
            
            <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 4px solid #007bff;">
                <strong>File Summary:</strong><br>
                • <strong>Destination:</strong> {{ $file->destination->name ?? 'N/A' }}<br>
                • <strong>Travelers:</strong> {{ $file->number_of_people }} People<br>
                • <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($file->start_date)->format('M d, Y') }}
            </div>
    
            <p>Please review the file details in the ERP system and update the status accordingly to ensure a seamless experience for our clients.</p>
            
            <p style="margin-top: 25px;">
                <a href="{{ config('app.url') }}/files/{{ $file->id }}" 
                   style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                   View File Details
                </a>
            </p>
        </div>
        <div class="footer">
            Created {{ $file->created_at->format('M d, Y H:i') }}
            | Last updated {{ $proforma->updated_at->format('M d, Y H:i') }}
            <br><br>
            {{ config('app.name') }}
        </div>
    </div>
</body>

</html>
