@extends('layouts.admin')

@section('title', 'Thêm mới admin')

@section('content')

<form action="{{route('admin.usermanagement.update', $user->id)}}" method='post' enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="row">
    <div class="col-md-8">
        <div class="form-group">
          <label for="name">Tên người dùng</label>
          <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Tên người dùng">
          @error('name')
          <small class="text-help text-danger">{{$message}}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="user_name">Tên đăng nhập</label>
          <input type="text" class="form-control" name="user_name" id="user_name" aria-describedby="helpId" placeholder="Tên đăng nhập">
          @error('user_name')
          <small class="text-help text-danger">{{$message}}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Email của bạn">
          @error('email')
          <small class="text-help text-danger">{{$message}}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="password">Mật khẩu</label>
          <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Mật khẩu">
          @error('password')
          <small class="text-help text-danger">{{$message}}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="number_phone">Số điện thoại</label>
          <input type="text" class="form-control" name="number_phone" id="number_phone" aria-describedby="helpId" placeholder="Số điện thoại">
          @error('number_phone')
          <small class="text-help text-danger">{{$message}}</small>
          @enderror
        </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="avatar">Ảnh</label>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#model_image">
                    <i class="fa fa-folder-open"></i>
                </button>
            </div>
            <div class="custom-file">
                <input type="text" class="form-control" name="avatar" id="avatar" aria-describedby="helpId" placeholder="Ảnh đại diện">
            </div>
        </div>

        <img src="" alt="" id="show_img">

        @error('avatar')
        <small class="text-help text-danger">{{$message}}</small>
        @enderror

      </div>
      <div class="form-group">
        <label for="status">Trạng thái</label>
        <select class="form-control" name="status" id="status">
          <option value=1 default>Hoạt động</option>
          <option value=0>Không hoạt động</option>
        </select>
        @error('status')
        <small class="text-help text-danger">{{$message}}</small>
        @enderror
      </div>
      <div class="form-group">
        <label for="level">Level</label>
        <input type="number" class="form-control" name="level" id="level" aria-describedby="helpId"
          placeholder="Level">

        @error('level')
        <small class="text-help text-danger">{{$message}}</small>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">Thêm mới</button>
    </div>
  </div>
</form>


<!-- Button trigger modal -->

<!-- Modal cho ảnh đại diện -->
<div class="modal fade" id="model_image" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:900px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Chọn ảnh đại diện của bạn</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <iframe src="{{url('file/dialog.php?field_id=avatar')}}"
            style="width:100%; height:500px; overflow-y: auto; border:none"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('css')
<!-- summernote -->
<link rel="stylesheet" href="{{url('adminlte123')}}/plugins/summernote/summernote-bs4.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

@endsection

@section('js')
<!-- Summernote -->
<script src="{{url('adminlte123')}}/plugins/summernote/summernote-bs4.min.js"></script>

<!-- Page specific script -->
<script>
    $(function() {
        // Summernote
        $('#mota').summernote({
            height: 200,
            placeholder: "Mô tả sản phẩm"
        })
    });

    $("#model_image").on('hidden.bs.modal', event => {
        var _link = $('input#avatar').val();
        var _img = "{{url('thumbs')}}" + "/" + _link;
        $('img#show_img').attr('src', _img)
    });

</script>
@endsection
