<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Posts Table</h2>       
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Id</th>
        <th>Post Title</th>
        <th>Post Content</th>
        <th>Tag Name </th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @php  $i = 1;  @endphp
      @foreach($Allpostdata as $data)
      <tr>
         <td>{{ $i }}</td>
        <td>{{  $data['title'] }}</td>
        <td>{{  $data['content']  }}</td>
        <td> {{ $data['tgas']  }}</td>
        <td><button class=" btn btn-success">Edit</button> <button class=" btn btn-danger">Delete</button></td>
      </tr>
  
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
