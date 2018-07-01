<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add employee</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <form method="post" action="/update-employee/{{$employee->id}}">
        @csrf
        <br>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">
                {{session('warning')}}
            </div>
        @endif
        @if(session('danger'))
            <div class="alert alert-danger">
                {{session('danger')}}
            </div>
        @endif
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{$employee->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{$employee->email}}">
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" class="form-control" id="role" placeholder="Enter role" name="role" value="{{$employee->role}}">
        </div>
        <div class="form-group">
            <label for="salary">Salary:</label>
            <input type="text" class="form-control" id="salary" placeholder="Enter salary" name="salary" value="{{$employee->salary}}">
        </div>

        <button type="submit" class="btn btn-default">Update employee</button>
    </form>

</div>

</body>
</html>
