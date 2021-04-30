@component('mail::message')
Hi {{ $data['name'] }} ,

{{ $data['name'] }} anda mendapat undangan ini untuk melakukan partisipasi {{ $data['acara'] }} yang di selenggarakan oleh Asosiasi Dana Pensiun Indonesia,

Gunakan suara anda untuk memilih calon Ketua Umum dan Ketua Pengawas Perkumpulan ADPI Periode 2021 - 2025.

Di bawah ini adalah hak akses anda.<br>
Username  : {{ $data['username'] }}<br>
Pasword   : {{ $data['pass'] }}<br>

eVoting akan diselenggarakan pada :

Hari & Tanggal : {{ $data['hari'] }}, {{ \Carbon\Carbon::parse($data['tanggal'])->format('d M Y') }} <br>
Sampai Tanggal : {{ $data['hariEnd'] }}, {{ \Carbon\Carbon::parse($data['tanggalSelesai'])->format('d M Y') }} <br>
Dimulai Pada   : {{ \Carbon\Carbon::parse($data['jamMulai'])->format('H:i:s') }} WIB<br>
Sampai         : {{ \Carbon\Carbon::parse($data['jamSelesai'])->format('H:i:s') }} WIB<br>

Akses eVoting Melalui : <a href="http://voting.dapenmapamsi.id"> Link ini </a> dengan menggunakan username dan password di atas.<br>

Yakinkan pilihan anda sebelum menekan tombol pilih pada masing-masing kandidat.

Ini adalah email otomatis, mohon tidak membalas email ini.

Untuk mengunjungi alamat silahkan klink <a href="http://voting.dapenmapamsi.id">link ini</a>

Terima Kasih.


Sincerely,<br>
{{ config('app.name') }}
@endcomponent
