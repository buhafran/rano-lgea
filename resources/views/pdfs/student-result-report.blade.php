<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Result Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Student Result Report</h2>
    <p><strong>Name:</strong> {{ $student->full_name }}</p>
    <p><strong>Admission No:</strong> {{ $student->admission_no }}</p>

    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>CA</th>
                <th>Exam</th>
                <th>Total</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>{{ $row['subject'] }}</td>
                    <td>{{ $row['ca_score'] }}</td>
                    <td>{{ $row['exam_score'] }}</td>
                    <td>{{ $row['total_score'] }}</td>
                    <td>{{ $row['grade'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>