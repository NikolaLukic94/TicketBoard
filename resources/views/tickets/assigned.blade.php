@component('mail::message')
# Ticket has been assigned to you

@component('mail::button', ['url' => ''])
See ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
