@component('mail::message')
Hello, {{ $data['name'] }} ,

{{ $data['name'] }} terima kasih anda telah berpartisipasi dalam pemilihan {{ $data['jenis'] }} Perkumpulan ADPI.

Ini adalah email otomatis, mohon jangan di balas.

Kunjungi halaman {{ env('APP_URL') }} untuk melihat secara langsung hasil perolehan suara.

Terima kasih.


Sincerely,<br>
{{ config('app.name') }}
@endcomponent
