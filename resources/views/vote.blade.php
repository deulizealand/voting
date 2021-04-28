{!! Form::open(['id'=>'frm']) !!}
    <div class="modal-header">
        <h5 class="modal-title">{{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body m-2">
        <div class="row">
            <div class="table-responsive">
                <table class="table dt-responsive nowrap my-0 dataPemilih">
                    <thead>
                        <tr>
                            <th width="100%">Asal Dana Pensiun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{!! Form::close() !!}
<script type="text/javascript">
    var uri = "{{ url()->current() }}";
    var id = "{{ $id }}";
    //console.log(uri);
    var table = $('.dataPemilih').DataTable();
</script>