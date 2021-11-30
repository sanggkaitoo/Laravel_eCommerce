<?php

namespace App\Http\Controllers;

use App\Models\Nhomsanpham;
use Illuminate\Http\Request;

class NhomsanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Nhomsanpham::where('ten', 'like', '%'.$key.'%')->orderby('uutien','DESC')->paginate(5);
        }
        else {
            $data = Nhomsanpham::orderby('uutien','DESC')->paginate(5);
        }

        return view('admin.nhomsanpham.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nhomsanpham.create');
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
            'ten'=>'required|unique:nhomsanpham,ten',
            'uutien'=>'required',
        ],
        [
            'ten.required' => 'Cần nhập tên nhóm sản phẩm',
            'ten.unique' => 'Tên nhóm sản phẩm cần duy nhất',
            'uutien.required' => "Cần nhập mức độ ưu tiên",

        ]
        );

        if (Nhomsanpham::create($request->all())){
            return redirect()->route('admin.nhomsanpham.index')->with('success','Thêm mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nhomsanpham  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function show(Nhomsanpham $nhomsanpham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nhomsanpham  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function edit(Nhomsanpham $nhomsanpham)
    {
        return view('admin.nhomsanpham.edit',["nhomsanpham"=>$nhomsanpham]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nhomsanpham  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nhomsanpham $nhomsanpham)
    {
        $request->validate([
            'ten'=>'required|unique:nhomsanpham,ten,'.$nhomsanpham->id,
            'uutien'=>'required',
        ],
        [
            'ten.required' => 'Cần nhập tên nhóm sản phẩm',
            'ten.unique' => 'Tên nhóm sản phẩm cần duy nhất',
            'uutien.required' => "Cần nhập mức độ ưu tiên",

        ]
        );

        if ($nhomsanpham->update($request->all())){
            return redirect()->route('admin.nhomsanpham.index')->with('success','Thêm mới thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nhomsanpham  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nhomsanpham $nhomsanpham)
    {
        //
        if ($nhomsanpham->sanphams()->count()>0){
            return redirect()->route('admin.nhomsanpham.index')->with('error','Xóa bản ghi không thành công do có chứa sản phẩm.');
        }
        else{
            $nhomsanpham->delete();
            return redirect()->route('admin.nhomsanpham.index')->with('success','Xóa bản ghi thành công.');
        }

    }
}
