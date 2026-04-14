<x-filament-panels::page>
    <div class="overflow-x-auto rounded-xl border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3 text-left">Ward</th>
                    <th class="p-3 text-left">Schools</th>
                    <th class="p-3 text-left">Primary Enrolment</th>
                    <th class="p-3 text-left">Teachers</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->rows as $row)
                    <tr class="border-t">
                        <td class="p-3">{{ $row['ward'] }}</td>
                        <td class="p-3">{{ $row['schools'] }}</td>
                        <td class="p-3">{{ $row['primary_enrolment'] }}</td>
                        <td class="p-3">{{ $row['teachers'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament-panels::page>