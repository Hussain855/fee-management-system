<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Profile</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; color: #2c3e50; }
        h3 { color: #2c3e50; border-bottom: 2px solid #2c3e50; padding-bottom: 5px; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 5px; }
        .summary { width: 100%; margin-bottom: 20px; }
        .summary td { padding: 10px; text-align: center; color: white; font-weight: bold; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #2c3e50; color: white; padding: 7px; text-align: left; }
        td { padding: 6px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { text-align: center; margin-top: 20px; color: #999; font-size: 10px; }
        .badge-paid { background: #28a745; color: white; padding: 2px 8px; border-radius: 3px; }
        .badge-pending { background: #6c757d; color: white; padding: 2px 8px; border-radius: 3px; }
        .badge-partial { background: #ffc107; color: white; padding: 2px 8px; border-radius: 3px; }
        .badge-overdue { background: #dc3545; color: white; padding: 2px 8px; border-radius: 3px; }
    </style>
</head>
<body>
    <h2>Fee Management System</h2>
    <p style="text-align:center; color:#666; margin-top:-10px;">Student Profile Report</p>

    <h3>Personal Information</h3>
    <table class="info-table">
        <tr>
            <td><strong>Name:</strong> {{ $student->name }}</td>
            <td><strong>Roll Number:</strong> {{ $student->roll_number }}</td>
        </tr>
        <tr>
            <td><strong>Class:</strong> {{ $student->classModel->name ?? 'N/A' }}</td>
            <td><strong>Section:</strong> {{ $student->section->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Guardian:</strong> {{ $student->guardian_name }}</td>
            <td><strong>Phone:</strong> {{ $student->phone }}</td>
        </tr>
        <tr>
            <td><strong>Address:</strong> {{ $student->address }}</td>
            <td><strong>Admission:</strong> {{ $student->date_of_admission }}</td>
        </tr>
    </table>

    <h3>Fee Summary</h3>
    <table>
        <tr>
            <th>Total Fees</th>
            <th>Total Paid</th>
            <th>Balance</th>
            <th>Total Fines</th>
            <th>Total Discounts</th>
        </tr>
        <tr>
            <td>Rs. {{ number_format($total_fees, 2) }}</td>
            <td>Rs. {{ number_format($total_paid, 2) }}</td>
            <td>Rs. {{ number_format($total_balance, 2) }}</td>
            <td>Rs. {{ number_format($total_fines, 2) }}</td>
            <td>Rs. {{ number_format($total_discounts, 2) }}</td>
        </tr>
    </table>

    <h3>Fee Dues</h3>
    <table>
        <thead>
            <tr>
                <th>Term</th>
                <th>Amount Due</th>
                <th>Amount Paid</th>
                <th>Balance</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student->feeDues as $due)
            <tr>
                <td>{{ $due->term->name ?? 'N/A' }}</td>
                <td>Rs. {{ number_format($due->amount_due, 2) }}</td>
                <td>Rs. {{ number_format($due->amount_paid, 2) }}</td>
                <td>Rs. {{ number_format($due->outstanding_balance, 2) }}</td>
                <td>
                    @if($due->status == 'Paid')
                        <span class="badge-paid">Paid</span>
                    @elseif($due->status == 'Partially Paid')
                        <span class="badge-partial">Partially Paid</span>
                    @elseif($due->status == 'Overdue')
                        <span class="badge-overdue">Overdue</span>
                    @else
                        <span class="badge-pending">Pending</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Payment History</h3>
    <table>
        <thead>
            <tr>
                <th>Amount</th>
                <th>Method</th>
                <th>Date</th>
                <th>Partial</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student->payments as $payment)
            <tr>
                <td>Rs. {{ number_format($payment->amount_paid, 2) }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->payment_date }}</td>
                <td>{{ $payment->is_partial ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ date('d M Y h:i A') }} — Fee Management System
    </div>
</body>
</html>