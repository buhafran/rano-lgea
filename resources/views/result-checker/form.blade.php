<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Checker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">
    <div class="max-w-xl mx-auto py-12 px-4">
        <div class="bg-white rounded-2xl shadow p-6">
            <h1 class="text-2xl font-bold mb-2">Student Result Checker</h1>
            <p class="text-slate-600 mb-6">Enter the admission number, session, term, and access code.</p>

            <form method="POST" action="{{ route('result-checker.check') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-1 font-medium">Admission Number</label>
                    <input type="text" name="admission_no" value="{{ old('admission_no') }}" class="w-full rounded-xl border px-4 py-3">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Academic Session</label>
                    <select name="academic_session_id" class="w-full rounded-xl border px-4 py-3">
                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}">{{ $session->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Term</label>
                    <select name="term_id" class="w-full rounded-xl border px-4 py-3">
                        @foreach($terms as $term)
                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Access Code / PIN</label>
                    <input type="text" name="access_code" value="{{ old('access_code') }}" class="w-full rounded-xl border px-4 py-3">
                </div>

                @if($errors->any())
                    <div class="rounded-xl bg-red-50 border border-red-200 p-3 text-red-700 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button class="w-full rounded-xl bg-teal-700 text-white py-3 font-semibold">Check Result</button>
            </form>
        </div>
    </div>
</body>
</html>