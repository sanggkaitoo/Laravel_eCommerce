<?php

namespace App\Http\Controllers;

use App\Models\Sanpham;
use Illuminate\Http\Request;
use App\Models\Nhomsanpham;
use Illuminate\Support\Facades\File;

class SanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Sanpham::where('ten', 'like', '%'.$key.'%')->orderby('uutien','DESC')->paginate(5);
        }
        else {
            $data = Sanpham::orderby('uutien','DESC')->paginate(5);
        }

        return view('admin.sanpham.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhomsanphams=Nhomsanpham::orderby('ten')->where('trangthai',1)->select('id','ten')->get();
        return view('admin.sanpham.create', compact('nhomsanphams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ten'=>'required|unique:sanpham',
            'gia'=>'required',
            'uutien'=>'required',
        ],
        [
            'ten.required' => 'Cần nhập tên nhóm sản phẩm',
            'ten.unique' => 'Tên nhóm sản phẩm cần duy nhất',
            'gia.required' => 'Cần nhập giá sản phẩm',
            'uutien.required' => "Cần nhập mức độ ưu tiên",

        ]
        );

        // Up load ảnh - Bỏ do sử dụng file manager

        // if ($request->has('file_upload')){
        //     $file=$request->file_upload;
        //     $ext=$file->extension();

        //     $file_name=time().'-sp.'.$ext;

        //     $file->move(public_path('uploads'), $file_name);
        //     $request->merge(['anh'=>$file_name]);
        // }

        if(Sanpham::create($request->all())){
            return redirect()->route('admin.sanpham.index')->with('success', 'Thêm mới sản phẩm thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function show(Sanpham $sanpham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function edit(Sanpham $sanpham)
    {
        $nhomsanphams=Nhomsanpham::orderby('ten')->where('trangthai',1)->select('id','ten')->get();

        return view('admin.sanpham.edit', ['sanpham'=>$sanpham, 'nhomsanphams'=>$nhomsanphams]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sanpham $sanpham)
    {
        $request->validate([
            'ten'=>'required|unique:nhomsanpham,ten,'.$sanpham->id,
            'gia'=>'required',
            'uutien'=>'required',
        ],
        [
            'ten.required' => 'Cần nhập tên nhóm sản phẩm',
            'ten.unique' => 'Tên nhóm sản phẩm cần duy nhất',
            'gia.required' => 'Cần nhập giá sản phẩm',
            'uutien.required' => "Cần nhập mức độ ưu tiên",

        ]
        );

        $deleteimage=false;

        $oldimage=public_path('uploads/'.$sanpham->anh);

        // if ($request->has('file_upload')){
        //     $file=$request->file_upload;
        //     $ext=$file->extension();

        //     $file_name=time().'-sp.'.$ext;

        //     $file->move(public_path('uploads'), $file_name);
        //     $request->merge(['anh'=>$file_name]);
        //     $deleteimage=true;
        // }else{
        //     $request->merge(['anh'=>$sanpham->anh]);
        // }

        // if($sanpham->update($request->only('ten','mota','danhsachanh','nhomsanphamid','gia','giaban','anh','trangthai','uutien'))){
        //     if ($deleteimage){
        //         File::delete($oldimage);
        //     }
        //     return redirect()->route('admin.sanpham.index')->with('success','Cập nhật sản phẩm thành công.');
        // }

        if($sanpham->update($request->all())) {
            return redirect()->route('admin.sanpham.index')->with('success','Cập nhật sản phẩm thành công.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sanpham $sanpham)
    {
        $sanpham->delete();
        return redirect()->route('admin.sanpham.index')->with('success','Xóa bản ghi thành công.');
    }
}
