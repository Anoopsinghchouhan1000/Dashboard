@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-8">
        <a href="{{route('products.create')}}" class="btn" class="text-decoration-none text-success">Add<h5><i class="bi bi-plus-circle-fill"></i></h5></a>
           <table class="table table-responsive table-hover table-noborder">
                <tr class="table-dark">
                    <th>Category name</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach($datas as $data)
                <tr>
                    <td>#{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->description}}</td>
                    <td><img src="{{url('images').'/'.$data->image}}" width="60px" height="40px"/></td>
                    <td><input type="checkbox" class="toggle-class" data-id="{{$data->id}}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{$data->status ? 'checked':''}}/></td>
                    <td><a href="{{route('products.edit',$data->id)}}"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{route('products.destroy',$data->id)}}" method="post" onsubmit="confirm('Are you sure you want to delete')">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn"><h5 class="text-danger"><i class="bi bi-trash"></i></h5></button>
                    </form>
                </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
    <script>
    $(function(){
        $('.toggle-class').change(function()
        {
          var status = $(this).prop('checked') == true ? 1:0;
          var user_id = $(this).data('id');
          
          $.ajax({
                type:"GET",
                dataType: "json",  
                url:"{{route('products.changeStatus')}}",
                data:{'status':status,'id':user_id},
                success: function(data){
                    console.log(data.success)
                }

          });
        })
    })
</script>

@endsection



