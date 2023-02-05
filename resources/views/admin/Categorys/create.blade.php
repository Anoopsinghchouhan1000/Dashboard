@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
        <a href="{{route('category.index')}}" class="text-decoration-none text-success">Back<h5><i class="bi bi-arrow-left-circle-fill"></i></h5>
</a>
        <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="id" value="{{$datas->id ?? ''}}"/>
            <label>Name:</label>
                <input type="text" name="name" value="{{$datas->name ?? ''}}" class="form-control"/>
                @error('name')
                <div class="text-danger">{{$message}}</div>
                @enderror
            <label>description:</label>
                <textarea class="form-control" name="description">{{$datas->description ?? ''}}</textarea>
                @error('description')
                <div class="text-danger">{{$message}}</div>
                @enderror
            <label>image:</label>
                <input type="file" name="image" class="form-control" value="{{$datas->image ?? ''}}"/></br>
            @if(isset($datas) && !empty($datas->image))
            <img src="{{url('image').'/'.$datas->image}}" width="60px" height="40px"/><br>
            @endif
            <label>status:</label>
                <select class="form-control" name="status">
                    <option value="1" {{isset($datas) && $datas->status==true ? "selected":''}}>Active</option>
                    <option value="0" {{isset($datas) && $datas->status==false ? "selected":''}}>In Active</option>
                </select></br>
            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
        </form>
        </div>
    </div>
</div>
@endsection