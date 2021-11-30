<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=User::paginate(15);

        if ($key=request()->key){
            $data=User::where('name','like','%'.$key.'%')->paginate(15);
        }

        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name'=>'required',
        //     'user_name'=>'required|unique:users',
        //     'email'=>'required|email|unique:users',
        //     'password'=>'required',
        //     'number_phone'=>'required',
        //     'avatar'=>'required',
        //     'status'=>'required',
        //     'level'=>'required'
        // ],
        // [
            //     'name.required'=>'Yêu cầu nhập họ và tên',
            //     'user_name.required'=>'Yêu cầu nhập username',
            //     'user_name.unique'=>'User đã tồn tại',
            //     'email.required'=>'Yêu cầu nhập Email',
            //     'email.unique'=>'Email đã tồn tại',
            //     'password.required'=>'Yêu cầu nhập mật khẩu',
            //     'number_phone.required'=>'Yêu cầu nhập số điện thoại',
            //     'avatar.required'=>'Yêu cầu chọn ảnh',
            //     'level.required'=>'Yêu cầu nhập Level'
            // ]
            // );

        // $validate = $request->validate([
        //     'name'=>'required',
        //     'user_name'=>'required|unique:users',
        //     'email'=>'required|email|unique:users',
        //     'password'=>'required',
        //     'number_phone'=>'required',
        //     'avatar'=>'required',
        //     'status'=>'required',
        //     'level'=>'required',
        // ]);

        $temp = $request->password;
        $password = \Hash::make($temp);
        $data = $request->all();
        $data['password'] = $password;

        // dd($request);

        if(User::create($data)){
            return redirect()->route('admin.usermanagement.index')->with('success', 'Thêm người dùng mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($user->update($request->all())) {
            return redirect()->route('admin.usermanagement.index')->with('success','Cập nhật thông tin người dùng thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.usermanagement.index')->with('success','Xóa người dùng thành công.');
    }
}
