<!DOCTYPE html>
<html>
<head>
    <title>Category Detial</title>
</head>
<body>
    <h1>{{ env('APP_NAME') }}</h1>

    <table class="table table-hover table-light table-responsive">
        <thead class="table-dark">
            <tr>
                <th>Name.</th>
                <th>Description.</th>
            </tr>
               
        </thead>
        <tbody>
            <tr>
            <td>{{$data['name']}}</td>
            <td><p>{{$data['description']}}</p></td>
            </tr>
            
        </tbody>
        </table>
</body>
</html>