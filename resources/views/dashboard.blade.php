@extends('layouts.master')

@section('head')
	@include('layouts.head')
@stop

@section('content')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>Dashboard</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-xxl d-flex">
            <div class="card illustration flex-fill">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-8">
                            <div class="illustration-text p-3 m-1">
                                <h4 class="illustration-text">Selamat Datang, {{ ucfirst(auth()->user()->name) }}!</h4>
                                <p class="mb-0">MUNAS Luar Biasa Tahun 2021</p>
                            </div>
                        </div>
                        <div class="col-4 align-self-end text-end">
                            <img src="{{ asset('images/customer-support.png') }}" alt="Customer Support" class="img-fluid illustration-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $jmlPemilih->jml }}</h3>
                            <p class="mb-2">Jumlah Pemilih</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-success me-2"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <i class="align-middle text-success" data-feather="aperture"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">
                                <a href="#modalForm" data-href="{{ url()->current() }}/0/data-pemilih" data-bs-toggle="modal" role="button" aria-pressed="true">
                                    {{ $jmlBlumPilih->jml }}
                                </a>
                            </h3>
                            <p class="mb-2">Belum Menyalurkan Pilihan</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-danger me-2"> <i class="mdi mdi-arrow-bottom-right"></i> </span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <i class="align-middle text-danger" data-feather="cloud-lightning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">
                                <a href="#modalForm" data-href="{{ url()->current() }}/1/data-pemilih" data-bs-toggle="modal" role="button" aria-pressed="true">
                                    {{ $jmlPilih->jml }}
                                </a>
                            </h3>
                            <p class="mb-2">Sudah Memilih</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-success me-2"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <i class="align-middle text-info" data-feather="camera"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            @php $jamSekarang = date('H:i:s A'); @endphp
            <h3>Live Voting </h3>
        </div>
    </div>
    <div class="row">
    @if(auth()->user()->role_id == 3)
        <div class="col-md-6 col-sm-6 col-xs-12 mb-2">
            <div class="card-header">
                <div class="card-title">Ketua Umum</div>
            </div>
            <div class="row">
                @foreach ($calons as $item)
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('images') }}/{{ $item->img_name }}" alt="{{ $item->name }}">
                            <div class="card-header">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title text-left">{{ $item->name }}</h5>
                                        <p class="card-text text-left">{{ $item->asal_dapen }}</p>
                                    </div>
                                    <div class="d-inline-block ms-3">
                                        <div class="stat text-center">
                                            <i class="align-middle text-info" id="total-{{ $item->id }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                            </div>
                            @if(auth()->user()->role_id == 3)
                                @if($member->vote_status == 0)
                                    @if($statusVoting)
                                        @if($statusVoting->status == 1)
                                        <div class="card-body text-center" id="pilihan">
                                            <a href="javascript:void(0);" onclick="selectOption({{ $item->id }});" class="btn btn-primary">Pilih</a>
                                        </div>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-12 mb-2">
            <div class="card-header">
                <div class="card-title">Ketua Pengawas</div>
            </div>
            <div class="row">
                @foreach ($pengawas as $item)
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('images') }}/{{ $item->img_name }}" alt="{{ $item->name }}">
                            <div class="card-header">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title text-left">{{ $item->name }}</h5>
                                        <p class="card-text text-left">{{ $item->asal_dapen }}</p>
                                    </div>
                                    <div class="d-inline-block ms-3">
                                        <div class="stat text-center">
                                            <i class="align-middle text-info" id="jumlah-{{ $item->id }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                            </div>
                            @if(auth()->user()->role_id == 3)
                                @if($member->vote_pengawas == 0)
                                    @if($statusVoting)
                                        @if($statusVoting->status == 1)
                                        <div class="card-body text-center" id="pilihanPengawas">
                                            <a href="javascript:void(0);" onclick="selectPengawas({{ $item->id }});" class="btn btn-primary">Pilih</a>
                                        </div>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
    @else
        <div class="col-md-6 col-sm-6 col-xs-12 mb-2">
            <div class="card-header">
                <div class="card-title">Ketua Umum</div>
            </div>
            <div class="row">
                @foreach ($calons as $item)
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('images') }}/{{ $item->img_name }}" alt="{{ $item->name }}">
                            <div class="card-header">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title text-left">{{ $item->name }}</h5>
                                        <p class="card-text text-left">{{ $item->asal_dapen }}</p>
                                    </div>
                                    <div class="d-inline-block ms-3">
                                        <div class="stat text-center">
                                            <i class="align-middle text-info" id="total-{{ $item->id }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-12 mb-2">
            <div class="card-header">
                <div class="card-title">Ketua Pengawas</div>
            </div>
            <div class="row">
                @foreach ($pengawas as $item)
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('images') }}/{{ $item->img_name }}" alt="{{ $item->name }}">
                            <div class="card-header">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title text-left">{{ $item->name }}</h5>
                                        <p class="card-text text-left">{{ $item->asal_dapen }}</p>
                                    </div>
                                    <div class="d-inline-block ms-3">
                                        <div class="stat text-center">
                                            <i class="align-middle text-info" id="jumlah-{{ $item->id }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
    @endif
    </div>
    @include('partials.modals.template')
@stop

@section('footer')
    @include('layouts.foot-js')
    @push('scripts')
    <script type="text/javascript">
        var uri = "{{ url()->current() }}";
        var jamServer = $('#jamSaatIni').text();
        //console.log(jamServer);

        setInterval(function() {refreshData()}, 1000);
        setInterval(function() {refreshDataPengawas()}, 1000);

        function refreshData()
        {
            $.ajax({
                url :  uri + '/refresh',
                type : 'get',
                success : function(data) {
                    //table.draw();
                    for(var a=0;a<data.length;a++){
                        $('#total-'+data[a].id).text(data[a].total);
                    }
                }
            });
        }
        
        function refreshDataPengawas()
        {
            $.ajax({
                url :  uri + '/refresh-pengawas',
                type : 'get',
                success : function(data) {
                    //table.draw();
                    //console.log(data);
                    for(var a=0;a<data.length;a++){
                        $('#jumlah-'+data[a].id).text(data[a].total);
                    }
                }
            });
        }

        function selectOption(id)
        {
            $.ajax({
                url :  uri + '/' + id + '/vote',
                type : 'get',
                success : function(data) {
                    //table.draw();
                    toastr.info('Pilihan anda sudah di simpan, terima kasih telah menggunakan hak suara anda!', 'info', {timeOut: 5000});
                    location.reload();
                    refreshData();
                    refreshDataPengawas();
                }
            });
        }

        function selectPengawas(id)
        {
            $.ajax({
                url :  uri + '/' + id + '/vote-pengawas',
                type : 'get',
                success : function(data) {
                    //table.draw();
                    toastr.info('Pilihan anda sudah di simpan, terima kasih telah menggunakan hak suara anda!', 'info', {timeOut: 5000});
                    location.reload();
                    refreshData();
                    refreshDataPengawas();
                    //refreshData();
                }
            });
        }

        var table = $('.dataUndangan').DataTable({
            processing:true,
            serverSide:true,
            bLengthChange :true,
            ajax: {
                url: uri
            },
            columns: [
                {data: 'gabungan', name: 'gabungan'},
                {data: 'judulundangan', name: 'judulundangan'},
                {data: 'konfirmasi', name: 'konfirmasi'},
                {data: 'status', name: 'status',className:'text-center'},
                {data: 'action', name: 'action',className:'text-center',orderable: false, searchable: false},
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
