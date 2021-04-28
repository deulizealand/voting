@extends('layouts.master')

@section('head')
    @include('layouts.head')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <h1 class="h3 mb-3">Daftar Peserta</h1>
    <div class="card flex-fill">
        <div class="card-header">
            <a data-bs-target="#modalForm" data-href="{{ url()->current() }}/1/create" data-bs-toggle="modal" class="btn btn-primary my-1" role="button" aria-pressed="true">Peserta Baru</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table dt-responsive nowrap my-0 dataPosisi">
                    <thead>
                        <tr>
                            <th width="40%">Nama Peserta</th>
                            <th width="40%">Asal Dana Pensiun</th>
                            <th width="13%">Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('partials.modals.template')
@stop

@section('footer')
    @include('layouts.foot-js')
    @push('scripts')
    
    <script type="text/javascript">
        var uri = "{{ url()->current() }}";
        
        var table = $('.dataPosisi').DataTable({
            processing:true,
            serverSide:true,
            bLengthChange :true,
            ajax: {
                url: uri
            },
            columns: [
                {data: 'gabungan', name: 'gabungan'},
                {data: 'asal', name: 'asal'},
                {data: 'status', name: 'status',className:'text-center'},
            ],
            order: [[0, 'asc']]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    </script>
    <script src="{{ asset('js/vimajs.js') }}"></script>
    @endpush
@stop
