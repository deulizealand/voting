@component('mail::message')
Hello, {{ $data['name'] }} ,

{{ $data['name'] }} terima kasih telah menggunakan hak suara anda.

Ini adalah email otomatis, mohon jangan di balas.

Pilihan anda adalah :<br>
Jenis Surat Suara : {{ $data['jenis'] }}<br>
Yang dipilih : {{ $data['pilahan'] }}<br>

Kunjungi halaman {{ env('APP_URL') }} untuk melihat secara langsung hasil perolehan suara.

Terima kasih.


Sincerely,<br>
{{ config('app.name') }}
@endcomponent
