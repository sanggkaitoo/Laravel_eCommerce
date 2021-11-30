@extends('layouts.admin')

@section('title', 'Quản lý file')

@section('content')

<iframe src="{{url('file/dialog.php')}}" style="width:100%; height:500px; overflow-y:auto; border:none">
</iframe>

@endsection
