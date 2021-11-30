@extends('layouts.admin')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')

<form action="{{route('admin.sanpham.update', $sanpham->id)}}" method='post' enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="nhomsanphamid">Nhóm sản phẩm</label>
                <select class="form-control" name="nhomsanphamid" id="nhomsanphamid">
                    @foreach ($nhomsanphams as $nsp )
                    <option value={{$nsp->id}} @if ($sanpham->nhomsanphamid==$nsp->id) selected='selected' @endif>{{$nsp->ten}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="ten">Tên</label>
                <input type="text" value="{{$sanpham->ten}}" class="form-control" name="ten" id="ten" aria-describedby="helpId" placeholder="Tên sản phẩm">
                @error('ten')
                <small class="text-help text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="mota">Mô tả</label>
                <textarea class="form-control" name="mota" id="mota" rows="6" placeholder='Mô tả sản phẩm' rows=8>{{$sanpham->mota}}</textarea>

            </div>
            <div class="form-group">
                <label for="danhsachanh">Danh sách ảnh</label>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#model_list">
                    <i class="fa fa-folder-open"></i>
                </button>
                </label>
                {{-- <input type="hidden" class="form-control" name="danhsachanh" id="danhsachanh" aria-describedby="helpId" placeholder="Danh sách ảnh"> --}}

                <input type="hidden" id="danhsachanh" name="danhsachanh" value="{{$sanpham->danhsachanh}}">

                <div class="row" id="show_danhsachanh">
                </div>
            </div>


        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="gia">Giá</label>
                <input type="number" value="{{$sanpham->gia}}" class="form-control" name="gia" id="gia" aria-describedby="helpId" placeholder="Giá">
                @error('gia')
                <small class="text-help text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="giaban">Giá bán</label>
                <input type="number" value="{{$sanpham->giaban}}" class="form-control" name="giaban" id="giaban" aria-describedby="helpId" placeholder="Giá bán">
            </div>
            <div class="form-group">
                <label for="file_upload">Ảnh </label>

                {{-- <input type="file" class="form-control" name="file_upload" id="file_upload" aria-describedby="helpId" placeholder="Ảnh sản phẩm"> --}}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#model_image">
                            <i class="fa fa-folder-open"></i>
                        </button>
                    </div>
                    <div class="custom-file">
                        <input type="text" class="form-control" name="anh" id="image" aria-describedby="helpId" placeholder="Ảnh sản phẩm">
                    </div>
                </div>

                @if($sanpham->anh)
                <img id="show_img" src="{{ url('thumbs/'.$sanpham->anh) }}">
                @endif

                @if(!($sanpham->anh))
                <img id="show_img" src="">
                @endif
            </div>
            <div class="form-group">
                <label for="trangthai">Trạng thái</label>
                <select class="form-control" name="trangthai" id="trangthai">
                    <option value=1 @if ($sanpham->trangthai==1) selected='selected' @endif>Hoạt động</option>
                    <option value=0 @if ($sanpham->trangthai==0) selected='selected' @endif>Không hoạt động</option>
                </select>
            </div>
            <div class="form-group">
                <label for="uutien">Mức ưu tiên</label>
                <input type="number" value="{{$sanpham->uutien}}" class="form-control" name="uutien" id="uutien" aria-describedby="helpId" placeholder="Mức ưu tiên">
                @error('uutien')
                <small class="text-help text-danger">{{$message}}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>

        </div>
    </div>
</form>

<!-- Modal cho ảnh sản phẩm đại diện -->
<div class="modal fade" id="model_image" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:900px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Chọn ảnh đại diện sản phẩm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <iframe src="{{url('file/dialog.php?field_id=image')}}"
            style="width:100%; height:500px; overflow-y: auto; border:none"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<!-- Modal cho danh sách ảnh -->
<div class="modal fade" id="model_list" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:900px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Chọn danh sách ảnh</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="{{url('file/dialog.php?field_id=danhsachanh')}}"
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
    })

    function refresh_danhsachanh(){
        var _links = $('input#danhsachanh').val();
        var _html = '';

        try {
            var _image_list = JSON.parse(_links);
        } catch(e) {
            var _img = "{{url('thumbs')}}" + "/" + _links;
            _html += '<div class="col-sm-2">';
            _html += '<img src="' + _img + '" alt="" style="width:100%">';
            _html += '</div>'
            $('show_danhsachanh').html(_img)
        }

        for (let i in _image_list) {
            let _img = "{{url('thumbs')}}" + '/' + _image_list[i];
            _html += '<div class="col-sm-2">';
            _html += '<img src="' + _img + '" alt="" style="width:100%">';
            _html += '</div>'
        }
        $('#show_danhsachanh').html(_html);

    }

    function refresh_anh() {
        var _link = $('input#image').val();
        var _img = "{{url('thumbs')}}" + "/" + _link;
        $('img#show_img').attr('src', _img)
    }

    $(function() {
        refresh_danhsachanh();
    });

    $("#model_list").on('hidden.bs.modal', event => {
        refresh_danhsachanh();
    });

    $("#model_image").on('hidden.bs.modal', event => {
        refresh_anh();
    });

</script>
@endsection
