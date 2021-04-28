<?php

namespace App\Http\Controllers;

use App\Imports\DapenImport;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Excel;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dapenUpload(Request $request)
    {
        if ($request->isMethod('get')){
            $member = new Member();
            $params = [
                'title' => 'Upload Daftar Dana Pensiun',
                'member' => $member,
            ];

            return view('members.import')->with($params);
        }else {
            $rules = [
                'lokasi_file' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return response()->json([
                    'fail' => true,
                    'errors' => $validator->errors()
                ]);
            
            Excel::import(new DapenImport(),request()->file('lokasi_file'));
            
            return response()->json([
                'fail' => false,
                'redirect_url' => url('members')
            ]);
        }
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $records = Member::all();

            return DataTables::of($records)
                ->addColumn('gabungan', function ($data) {
                    $uri_tamu = route('members.create',['sistem_id'=> 1]);
                    return '<div class="media-left">
                                <div class="media-body">
                                    <a href="#modalForm" data-href="'.$uri_tamu.'/'.$data->id.'/update" data-bs-toggle="modal" class="text-semibold">'.$data->name.'</a>
                                </div>
                                <div class="text-muted text-size-small"><span class="text-semibold">'.$data->email.'</span>
                                </div>
                            </div>';
                })
                ->addColumn('action', function ($data) {
                    $uri_tamu = route('members.create',['sistem_id'=> 1]);
                    //$uri_add = route('kepesertaan.komda.mitra.create',['komda_id'=> $data->komda_id]);
                    return '<a href="#" data-id='.$data->id.' data-token="{{csrf_token()}}" data-bs-toggle="tooltip" title="Hapus Posisi">
                                <i class="align-middle" data-feather="trash"></i></a>';
                })
                ->rawColumns(['gabungan','action'])
                ->make(true);
        }
        return view('members.index');
    }

    public function addMember(Request $request, $sistem_id)
    {
        if ($request->isMethod('get')){
            $member  = new Member;
            $save_state = 'add';
            $title ="Pemilih Baru";
            return view('members.form',compact('member','save_state','title'));
            
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

            $peserta = new Member();
            $peserta->name = $request->name;
            $peserta->email = $request->email;
            $peserta->save();
        }
    }

    public function editMember(Request $request, $sistem_id, $id)
    {
        if ($request->isMethod('get')){
            $member  = Member::find($id);
            $save_state = 'edit';
            $title ="Edit Data Pemilih";
            return view('members.form',compact('member','save_state','title'));
            
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

            $peserta = Member::find($id);
            $peserta->name = $request->name;
            $peserta->email = $request->email;
            $peserta->save();
        
            return response()->json([
                'fail' => false,
                'redirect_url' => route('members')
            ]);
        }
    }
}
