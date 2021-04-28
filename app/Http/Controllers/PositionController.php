<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $records = Position::all();

            return DataTables::of($records)
                ->addColumn('gabungan', function ($data) {
                    $uri_tamu = route('positions.create',['sistem_id'=> 1]);
                    return '<div class="media-left">
                                <div class="media-body">
                                    <a href="#modalForm" data-href="'.$uri_tamu.'/'.$data->id.'/update" data-bs-toggle="modal" class="text-semibold">'.$data->name.'</a>
                                </div>
                            </div>';
                })
                ->editColumn('status',function($data){
                    if($data->status==0){
                        return '<span class="badge bg-success">Aktif</span>';
                    }else{
                        return '<span class="badge bg-warning">Tidak Aktif</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $uri_tamu = route('positions.create',['sistem_id'=> 1]);
                    //$uri_add = route('kepesertaan.komda.mitra.create',['komda_id'=> $data->komda_id]);
                    return '<a href="#" data-id='.$data->id.' data-token="{{csrf_token()}}" data-bs-toggle="tooltip" title="Hapus Posisi">
                                <i class="align-middle" data-feather="trash"></i></a>';
                })
                ->rawColumns(['gabungan','status','action'])
                ->make(true);
        }
        return view('positions.index');
    }

    public function addPosition(Request $request, $sistem_id)
    {
        if ($request->isMethod('get')){
            $jabatan  = new Position;
            $save_state = 'add';
            $title ="Posisi Baru";
            return view('positions.posisi',compact('jabatan','save_state','title'));
            
        }else {
            $rules = [
                'name' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
                ]);
                
            $peserta = new Position();
            $peserta->name = $request->name;
            $peserta->user_id = auth()->user()->id;
            $peserta->save();
            
            return response()->json([
                'fail' => false,
                'redirect_url' => route('positions')
            ]);
        }
    }

    public function editPosition(Request $request, $sistem_id, $id)
    {
        if ($request->isMethod('get')){
            $jabatan  = Position::find($id);
            $save_state = 'edit';
            $title ="Edit Posisi";
            return view('positions.posisi',compact('jabatan','save_state','title'));
            
        }else {
            $rules = [
                'name' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
                ]);
                
            $peserta = Position::find($id);
            $peserta->name = $request->name;
            $peserta->save();
            
            return response()->json([
                'fail' => false,
                'redirect_url' => route('positions')
            ]);
        }
    }
}
