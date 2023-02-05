@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-8">
        <a href="{{route('products.index')}}" class="btn text-decoration-none text-success"><h5><i class="bi bi-arrow-left-circle-fill"></i></h5></a>
            <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="id" value="{{$datas->id ?? ''}}"/>
                <label>Select Category:</label>
                <select class="form-control" name="category_id">
                @foreach($categorys as $category)
                    <option value="{{$category->id}}" {{old('category_id', isset($datas) && $datas->category_id==$category->id ? "selected":'')}}>{{$category->name}}</option>
                @endforeach
                </select>
                @error('category_id')
                <small class="text-danger text-small">{{$message}}*</small>
                @enderror</br>

                <label>Name:</label>
                <input type="text" name="name" value="{{$datas->name ?? ''}}" class="form-control"/>
                @error('name')
                <small class="text-danger text-small">{{$message}}*</small>
                @enderror</br>

                <label>Description:</label>
                <textarea name="description" class="form-control">{{$datas->description ??''}}</textarea>
                @error('description')
                <small class="text-danger text-small">{{$message}}*</small>
                @enderror</br>

                <label>Image:</label>
                <input type="file" name="image" value="{{$datas->image ??''}}" class="form-control"/></br>
                @if(isset($datas) && !empty($datas->image))
                <img src="{{url('images').'/'.$datas->image}}" width="60px" height="40px"/></br>
                @endif  

                <label>Status:</label>
                <select class="form-control" name="status">
                    <option value="1" {{isset($datas) && $datas->status=="1" ? "selected":''}}>Active</option>
                    <option value="0" {{isset($datas) && $datas->status=="0" ? "selected":''}}>In Active</option>
                </select>
                @error('status')
                <small class="text-danger text-small">{{$message}}*</small>
                @enderror</br>

                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                
            </form>
        </div>
    </div>
</div>
@endsection

