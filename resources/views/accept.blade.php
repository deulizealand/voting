@extends('layouts.app')

@section('head')
	@include('layouts.head')
@stop

@section('content')
    <div class="row h-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center">
                    <h1 class="display-1 fw-bold">Aktivasi Berhasil</h1>
                    <p class="h1">Terima Kasih</p>
                    <p class="h2 fw-normal mt-3 mb-4">Untuk melanjutkan aktifitas silahkan klik tombol login di bawah ini.</p>
                    <a href="{{ route('login') }}" class="btn btn-info">Login</a>
                </div>

            </div>
        </div>
    </div>
@stop

@section('footer')
    @push('scripts')
    <script type="text/javascript">
        var uri = "{{ url()->current() }}";
        
    </script>
    <script src="{{ asset('js/vimajs.js') }}"></script>
    @endpush
@stop