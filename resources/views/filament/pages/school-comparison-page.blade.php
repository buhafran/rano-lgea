<x-filament-panels::page>
    <div class="overflow-x-auto rounded-xl border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3 text-left">School</th>
                    <th class="p-3 text-left">Primary Enrolment</th>
                    <th class="p-3 text-left">Teachers</th>
                    <th class="p-3 text-left">Usable Classrooms</th>
                    <th class="p-3 text-left">Water</th>
                    <th class="p-3 text-left">Health</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->comparisonRows as $row)
                    <tr class="border-t">
                        <td class="p-3">{{ $row['school'] }}</td>
                        <td class="p-3">{{ $row['primary_enrolment'] }}</td>
                        <td class="p-3">{{ $row['teachers'] }}</td>
                        <td class="p-3">{{ $row['usable_classrooms'] }}</td>
                        <td class="p-3">{{ $row['water'] }}</td>
                        <td class="p-3">{{ $row['health'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament-panels::page>