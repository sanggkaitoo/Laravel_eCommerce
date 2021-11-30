@extends('layouts.admin')

@section('title',"Danh sách người dùng")

@section('content')
<div class="row mt-2">
  <div class="col">
    <form action="" class="form-inline">
      <div class="form-group">
        <input type="text" name="key" class="form-control" placeholder="Search by name" aria-describedby="helpId">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </form>
  </div>
  <div class="col">
    <a href="{{url('admin/user/create')}}" class="btn btn-primary float-right">Thêm mới</a>
  </div>
</div>
<hr>

<table class="table table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Email</th>
      <th>Level</th>
      <th>Status</th>
      <th class='text-right'>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $user)
    <tr>
      <td>{{$user->id}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
        @if($user->level==0)
        <span class="badge badge-danger">Sys admin</span>
        @elseif ($user->level==1)
        <span class="badge badge-success">Người quản lý</span>
        @else
        <span class="badge badge-success">User</span>
        @endif
      </td>
      <td>
        @if($user->status==0)
        <span class="badge badge-danger">Deleted</span>
        @else
        <span class="badge badge-success">Active</span>
        @endif
      </td>
      <td class='text-right'>
        <a href="{{route('admin.usermanagement.edit',$user->id)}}" class="btn btn-sm btn-success">
          <i class="fas fa-edit"></i>
        </a>
        <a href="{{route('admin.usermanagement.destroy',$user->id)}}" class="btn btn-sm btn-danger btndelete">
          <i class="fas fa-trash"></i>
        </a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<form action="" method="post" id='form-delete'>
  @csrf @method('DELETE')
</form>

{{$data->appends(Request::all())->links()}}
@endsection


@section('js')
<script>
$('.btndelete').click(function(ev) {
  ev.preventDefault();
  var _href = $(this).attr('href');
  $('form#form-delete').attr('action', _href);
  if (confirm('Bạn muốn xóa bản ghi này không?')) {
    $('form#form-delete').submit()
  }

});
</script>
@endsection
