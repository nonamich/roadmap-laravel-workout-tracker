<x-mail::message>
# Schedule need action

<x-mail::button url="{{ route('schedules.show', ['schedule' => $schedule]) }}">
    See
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
