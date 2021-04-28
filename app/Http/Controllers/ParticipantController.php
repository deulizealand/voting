<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Image;
use File;

class ParticipantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $records = Participant::with('posisi')->get();

            return DataTables::of($records)
                ->addColumn('gabungan', function ($data) {
                    $uri_tamu = route('participants.create',['sistem_id'=> 1]);
                    return '<div class="media-left">
                                <div class="media-body">
                                    <a href="#modalForm" data-href="'.$uri_tamu.'/'.$data->id.'/update" data-bs-toggle="modal" class="text-semibold">'.$data->name.'</a>
                                </div>
                                <div class="text-muted text-size-small"><span class="text-semibold">'.$data->posisi->name.'</span>
                                </div>
                            </div>';
                })
                ->addColumn('asal',function($data){
                    return '<div class="media-left">
                                <div class="text-muted text-size-small"><span class="text-semibold">'.$data->asal_dapen.'</span>
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
                    $uri_tamu = route('participants.create',['sistem_id'=> 1]);
                    //$uri_add = route('kepesertaan.komda.mitra.create',['komda_id'=> $data->komda_id]);
                    return '<a href="#" data-id='.$data->id.' data-token="{{csrf_token()}}" data-bs-toggle="tooltip" title="Hapus Posisi">
                                <i class="align-middle" data-feather="trash"></i></a>';
                })
                ->rawColumns(['gabungan','asal','status','action'])
                ->make(true);
        }
        return view('partisipants.index');
    }

    public function addPosition(Request $request, $sistem_id)
    {
        if ($request->isMethod('get')){
            $peserta  = new Participant;
            $save_state = 'add';
            $title ="Peserta Baru";
            return view('partisipants.form',compact('peserta','save_state','title'));
            
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

            $data = Participant::find(0);
            $image = $request->image_url;

            if ($image != "") {
                $logo = time(). rand(1111, 9999) . '.' .$image->getClientOriginalExtension();

                $save_Path = public_path('images/'.$logo);
                
                Image::make($image->getRealPath())->resize(300, 236)->save($save_Path);
            } else {
                $logo = "";
            }
            try{

                if($logo==""){
                    $peserta = new Participant();
                    $peserta->name = $request->name;
                    $peserta->position_id = $request->position_id;
                    $peserta->asal_dapen = $request->asal_dapen;
                    $peserta->user_id = auth()->user()->id;
                    $peserta->save();
                    
                    return response()->json([
                        'fail' => false,
                        'redirect_url' => route('participants')
                    ]);
                }else{
                    $peserta = new Participant();
                    $peserta->name = $request->name;
                    $peserta->position_id = $request->position_id;
                    $peserta->asal_dapen = $request->asal_dapen;
                    $peserta->img_name = $logo;
                    $peserta->user_id = auth()->user()->id;
                    $peserta->save();
                    
                    return response()->json([
                        'fail' => false,
                        'redirect_url' => route('participants')
                    ]);
                }
            } catch(\Exception $e) {
                $notification = array(
                    'message' => $e->getMessage(),
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }
    }

    public function editPosition(Request $request, $sistem_id, $id)
    {
        if ($request->isMethod('get')){
            $peserta  = Participant::find($id);
            $save_state = 'edit';
            $title ="Edit Posisi";
            return view('partisipants.form',compact('peserta','save_state','title'));
            
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
                
            $image = $request->image_url;

            $peserta = Participant::find($id);
            if ($image != "") {
                $logo = time(). rand(1111, 9999) . '.' .$image->getClientOriginalExtension();

                $save_Path = public_path('images/'.$logo);
                
                if ($peserta->img_name != "") {
                    if($peserta->image != $image){
                        File::delete(public_path('images/' . $peserta->image));
                        Image::make($image->getRealPath())->resize(300, 236)->save($save_Path);
                    }
                } else {
                    Image::make($image->getRealPath())->resize(300, 236)->save($save_Path);
                }
                $peserta->name = $request->name;
                $peserta->img_name = $logo;
                $peserta->asal_dapen = $request->asal_dapen;
                $peserta->position_id = $request->position_id;
                $peserta->save();
            } else {
                $logo = "";

                $peserta->name = $request->name;
                $peserta->position_id = $request->position_id;
                $peserta->asal_dapen = $request->asal_dapen;
                $peserta->save();
            }
        
            return response()->json([
                'fail' => false,
                'redirect_url' => route('participants')
            ]);
        }
    }
}
