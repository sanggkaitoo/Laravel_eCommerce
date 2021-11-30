@extends('layouts.admin')

@section('title','Thêm mới nhóm sản phẩm')

@section('content')
    <form action="{{route('admin.nhomsanpham.store')}}" method='post'>
        @csrf
        <div class="form-group">
          <label for="tennhomsanpham">Tên nhóm sản phẩm</label>
          <input type="text" value="{{old('ten')}}" class="form-control" name="ten" id="tennhomsanpham" aria-describedby="helpId" placeholder="Tên nhóm sản phẩm">
          @error('ten')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="trangthai">Trạng thái</label>
          <select class="form-control" name="trangthai" id="trangthai">
            <option value=1 @if (old('trangthai')==1) selected='selected' @endif>Hoạt động</option>
            <option value=0 @if (old('trangthai')!=null and old('trangthai')==0) selected='selected' @endif>Không hoạt động</option>
          </select>
        </div>
        <div class="form-group">
          <label for="uutien">Mức ưu tiên</label>
          <input type="number" value="{{old('uutien')}}" class="form-control" name="uutien" id="uutien" aria-describedby="helpId" placeholder="Mức ưu tiên">
          @error('uutien')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection
