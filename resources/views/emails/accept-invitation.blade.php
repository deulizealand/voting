@component('mail::message')
Hi {{ $data['user'] }} ,

{{ $data['user'] }} thanks to accept this invitation, now you can log in to this app.

@component('mail::button', ['url' => $data['url']])
Login
@endcomponent

This is an automated system email. Please do not reply to this email.

Visit our website at {{ env('APP_URL') }} to learn more about us, or contact our support at {{ env('MAIL_FROM_ADDRESS') }}.

Thank you.


Sincerely,<br>
{{ config('app.name') }}
@endcomponent
