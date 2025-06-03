<x-mail::message>
    # Schedules Workout need report

    <x-mail::button :url="route('schedules.show', $scheduleId)">
        Report
    </x-mail::button>

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
