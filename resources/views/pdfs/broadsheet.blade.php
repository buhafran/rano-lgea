<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Broadsheet</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Broadsheet</h2>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Subjects / Scores</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $student => $scores)
                <tr>
                    <td>{{ $student }}</td>
                    <td>
                        @foreach($scores as $score)
                            {{ $score->subject?->name }}: {{ $score->total_score }} ({{ $score->grade }})<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>