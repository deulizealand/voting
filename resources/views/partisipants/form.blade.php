@if(!$peserta->id)
{!! Form::open(['id'=>'frm','enctype'=>'multipart/form-data']) !!}
@else
{!! Form::model($peserta,['method'=>'put','id'=>'frm','enctype'=>'multipart/form-data']) !!}
@endif
    <div class="modal-header">
        <h5 class="modal-title">{{!$peserta->id ? $title : $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body m-2">
        <div class="row mt-1">
            <div class="col-md-6">
                <div class="form-floating">
                    {{ Form::text('name',null, ['id'=>'name', 'class'=>'form-control','placeholder'=>'Jabatan'] ) }}
                    <label for="name">Nama Jabatan</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    {{ Form::select('position_id', \App\Helpers\Helper::getDaftarJabatan(), $peserta->position_id , ['id'=>'position_id', 'class'=>'form-control select2','data-toggle'=>'select2','placeholder'=>'Pilih Posisi']) }}
                    <label for="position_id">Jabatan</label>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="form-floating">
                    {{ Form::text('asal_dapen',null, ['id'=>'asal_dapen', 'class'=>'form-control','placeholder'=>'Asal Dana Pensiun'] ) }}
                    <label for="asal_dapen">Asal Dana Pensiun</label>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="form-floating">
                    @if($peserta->img_name != "")
                    <input type="file" name="image_url" id="image_url" class="drop" data-default-file="{{ asset('images/'.$peserta->img_name) }}">
                    @else
                    <input type="file" name="image_url" id="image_url" class="drop">
                    @endif
                    <label for="image_url">Foto Peserta</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Tutup</button>
        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Simpan</button>
    </div>
{!! Form::close() !!}
<script src="{{ asset('js/dropify.min.js') }}"></script>
<script type="text/javascript">
    $('.drop').dropify();
</script>