<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Students List</title>
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
    <p>Students List — Generated on {{ date('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Roll Number</th>
                <th>Class</th>
                <th>Section</th>
                <th>Guardian</th>
                <th>Phone</th>
                <th>Admission Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->roll_number }}</td>
                <td>{{ $student->classModel->name ?? 'N/A' }}</td>
                <td>{{ $student->section->name ?? 'N/A' }}</td>
                <td>{{ $student->guardian_name }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->date_of_admission }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Total Students: {{ count($students) }} — Fee Management System
    </div>
</body>
</html>