@if(!$jabatan->id)
{!! Form::open(['id'=>'frm']) !!}
@else
{!! Form::model($jabatan,['method'=>'put','id'=>'frm']) !!}
@endif
    <div class="modal-header">
        <h5 class="modal-title">{{!$jabatan->id ? $title : $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body m-2">
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="form-floating">
                    {{ Form::text('name',null, ['id'=>'name', 'class'=>'form-control','placeholder'=>'Jabatan'] ) }}
                    <label for="name">Nama Jabatan</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Tutup</button>
        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Simpan</button>
    </div>
{!! Form::close() !!}