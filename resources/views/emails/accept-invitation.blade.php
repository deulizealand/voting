@component('mail::message')
Hi {{ $details['user'] }} ,

{{ $details['user'] }} thanks to accept this invitation, now you can log in to this app.

@component('mail::button', ['url' => $details['url']])
Login
@endcomponent

This is an automated system email. Please do not reply to this email.

Visit our website at {{ env('URL') }} to learn more about us, or contact our support at {{ env('MAIL_SUPPORT') }}.

Thank you.


Sincerely,<br>
{{ config('app.name') }}
@endcomponent
