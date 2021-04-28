@component('mail::message')
Hi {{ $data['name'] }} ,

{{ $data['name'] }} anda mendapat undangan ini untuk melakukan partisipasi MUNAS Luar Biasa Tahun 2021 yang di selenggarakan oleh Asosiasi Dana Pensiun Indonesia,

Gunakan suara anda untuk memilih calon Ketua Umum dan Ketua Pengawas Perkumpulan ADPI Periode 2021 - 2025.

Di bawah ini adalah hak akses anda.
Username : {{ $data['username'] }}<br>
Pasword  : {{ $data['pass'] }}<br>

Link Undangan : {{ $data['url_invitation'] }}

Yakinkan pilihan anda sebelum menekan tombol pilih pada masing-masing kandidat.

Ini adalah email otomatis, mohon tidak membalas email ini.

Untuk mengunjungi alamat silahkan klink link <a href="http://voting.dapenmapamsi.id">ini</a>

Terima Kasih.


Sincerely,<br>
{{ config('app.name') }}
@endcomponent
