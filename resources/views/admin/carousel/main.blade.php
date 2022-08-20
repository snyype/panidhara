<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<table class="table">
<tr>
    <th style="width: 40px;">id</th>
    <th style="width: 40px;">Name</th>
    <th style="width: 40px;">Description</th>
    <th style="width: 40px;">Image</th>
    <th colspan="3">Actions</th>
</tr>
@foreach ($data as $post )
    <tr>
        <td style="width: 40px;">{{$post->id}}</td>
        <td style="width: 40px;">{{$post->name}}</td>
       
        <td style="width: 40px;">{{$post->desc  }}</td>
        <td style="width: 40px;">{{$post->gallery}}</td>
        <td style="width: 40px;"><a href="/slider/{{$post->id}}/edit"><button class="btn btn-info">Edit</button></a></td>
        <form method="POST" action="/slider/{{$post->id}}">
        @csrf
        @method('delete')
        <td><input class="btn btn-warning" type="submit" value="Delete"></td>
        </form>
        <td><a href="/post/{{$post->id}}"><button class="btn btn-success">View</button></a></td>


    </tr>
@endforeach

</table>
<a href="/slider/create" class="btn btn-primary" >Add Tanker</a>
</body>
</html>