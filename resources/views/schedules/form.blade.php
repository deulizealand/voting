@if(!$schedule->id)
{!! Form::open(['id'=>'frm']) !!}
@else
{!! Form::model($schedule,['method'=>'put','id'=>'frm']) !!}
@endif
    <div class="modal-header">
        <h5 class="modal-title">{{!$schedule->id ? $title : $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body m-2">
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="form-floating">
                    {{ Form::text('voting_name',null, ['id'=>'voting_name', 'class'=>'form-control','placeholder'=>'Judul Voting'] ) }}
                    <label for="voting_name">Judul Voting</label>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-6">
                <div class="form-floating">
                    {{ Form::date('voting_date',null, ['id'=>'voting_date', 'class'=>'form-control'] ) }}
                    <label for="voting_date">Tanggal Pemilihan</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    {{ Form::time('voting_time',null, ['id'=>'voting_time', 'class'=>'form-control'] ) }}
                    <label for="voting_time">Jam Pemilihan</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Tutup</button>
        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Simpan</button>
    </div>
{!! Form::close() !!}