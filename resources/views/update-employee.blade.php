@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="/update-employee/{{$employee->id}}">
                    @csrf
                    <br>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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
                    <div class="form-group">
                        <label for="skills">Skills:</label>
                        <input type="text" class="form-control" id="skills" placeholder="Comma separated skills" name="skills" value="{{$employee->skills}}">
                    </div>

                    <button type="submit" class="btn btn-success">Update employee</button>
                </form>
            </div>
        </div>
    </div>
@endsection
