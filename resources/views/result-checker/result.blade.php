<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">
    <div class="max-w-4xl mx-auto py-12 px-4">
        <div class="bg-white rounded-2xl shadow p-6 mb-6">
            <h1 class="text-2xl font-bold mb-2">Result Summary</h1>
            <p><strong>Student:</strong> {{ $student->full_name }}</p>
            <p><strong>Admission No:</strong> {{ $student->admission_no }}</p>
            <p><strong>School:</strong> {{ optional($scores->first())->school?->name }}</p>
            <p><strong>Session:</strong> {{ optional($scores->first())->academicSession?->name }}</p>
            <p><strong>Term:</strong> {{ optional($scores->first())->term?->name }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="p-3 text-left">Subject</th>
                        <th class="p-3 text-left">CA</th>
                        <th class="p-3 text-left">Exam</th>
                        <th class="p-3 text-left">Total</th>
                        <th class="p-3 text-left">Grade</th>
                        <th class="p-3 text-left">Remark</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($scores as $score)
                        <tr class="border-t">
                            <td class="p-3">{{ $score->subject?->name }}</td>
                            <td class="p-3">{{ $score->ca_score }}</td>
                            <td class="p-3">{{ $score->exam_score }}</td>
                            <td class="p-3">{{ $score->total_score }}</td>
                            <td class="p-3">{{ $score->grade }}</td>
                            <td class="p-3">{{ $score->remark }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>