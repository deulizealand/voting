@if(!$pilih->id)
{!! Form::open(['id'=>'frm']) !!}
@else
{!! Form::model($pilih,['method'=>'put','id'=>'frm']) !!}
@endif
    <div class="modal-header">
        <h5 class="modal-title">{{!$pilih->id ? $title : $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body m-2">
        <div class="row">
            <div class="table-responsive">
                <table class="table dt-responsive nowrap my-0 dataPosisi">
                    <thead>
                        <tr>
                            <th width="70%">Asal Dana Pensiun</th>
                            <th width="13%">Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Tutup</button>
        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Simpan</button>
    </div>
{!! Form::close() !!}