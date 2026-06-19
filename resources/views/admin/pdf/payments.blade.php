<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payments List</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; color: #2c3e50; }
        p { text-align: center; color: #666; margin-top: -10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #2c3e50; color: white; padding: 8px; text-align: left; }
        td { padding: 7px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { text-align: center; margin-top: 30px; color: #999; font-size: 10px; }
    </style>
</head>
<body>
    <h2>Fee Management System</h2>
    <p>Payments Report — Generated on {{ date('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Amount Paid</th>
                <th>Payment Method</th>
                <th>Payment Date</th>
                <th>Partial</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $index => $payment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $payment->student->name ?? 'N/A' }}</td>
                <td>Rs. {{ number_format($payment->amount_paid, 2) }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->payment_date }}</td>
                <td>{{ $payment->is_partial ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Total Payments: {{ count($payments) }} — Fee Management System
    </div>
</body>
</html>