@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
        <a href="{{route('category.create')}}" class="text-decoration-none text-success">Add<h5><i class="bi bi-plus-circle-fill"></i></h5></a>
        <a class="btn btn-primary" href="{{ route('categoryshare') }}">Export to PDF</a>
        </br>
        <table class="table table-hover table-light table-responsive">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>Name.</th>
                <th>Description.</th>
                <th>Image.</th>
                <th>Status.</th>
                <center><th>Action.</th></center>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $category)
            <tr>
                <td>#{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td><img src="{{url('image').'/'.$category->image}}" width="60px" height="40px"/></td>
                <td><span class="badge badge-secondary bg-success">{{$category->status==1?'Active':'In Active'}}</span></td>
                 <td><a href="{{route('category.edit',$category->id)}}" class="text-decoration-none text-success"><h6><i class="bi bi-pencil-square"></i></h6></a>
                <form action="{{route('category.destroy',$category->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete')">
                @csrf
                @method('delete') 
                <button type="submit" class="btn btn-sm text-danger"><h6><i class="bi bi-trash"></i></h6></submit>
                </form> 
                </td>         
                 <tr>
            @endforeach
        </tbody>
        </table>
        </div>
    </div>
</div>
@endsection