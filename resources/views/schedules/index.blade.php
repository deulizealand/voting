@extends('layouts.master')

@section('head')
    @include('layouts.head')
@stop

@section('content')
    <h1 class="h3 mb-3">Daftar Jadwal Voting</h1>
    <div class="card flex-fill">
        <div class="card-header">
            <a data-bs-target="#modalForm" data-href="{{ url()->current() }}/1/create" data-bs-toggle="modal" class="btn btn-primary my-1" role="button" aria-pressed="true">Jadwal Pemilihan Baru</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table dt-responsive nowrap my-0 dataJadwal">
                    <thead>
                        <tr>
                            <th width="60%">Keterangan</th>
                            <th width="13%">Waktu</th>
                            <th width="13%">Status</th>
                            <th width="13%">Action</th>
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
        
        var table = $('.dataJadwal').DataTable({
            processing:true,
            serverSide:true,
            bLengthChange :true,
            ajax: {
                url: uri
            },
            columns: [
                {data: 'gabungan', name: 'gabungan'},
                {data: 'waktuvoting', name: 'waktuvoting',className:'text-center'},
                {data: 'status', name: 'status',className:'text-center'},
                {data: 'action', name: 'action',className:'text-center'},
            ],
            order: [[0, 'asc']]
        });

        function postActive(id)
        {
            $.ajax({
                url :  uri + '/' + id + '/mulai',
                type : 'post',
                success : function(data) {
                    table.draw();
                    toastr.info('Schedule Pemilihan di mulai', 'info', {timeOut: 5000});
                }
            });
        }

        function postStop(id)
        {
            $.ajax({
                url :  uri + '/' + id + '/berhenti',
                type : 'post',
                success : function(data) {
                    table.draw();
                    toastr.info('Schedule Pemilihan di berhentikan', 'info', {timeOut: 5000});
                }
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    </script>
    <script src="{{ asset('js/vimajs.js') }}"></script>
    @endpush
@stop
