@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="/save-employee">
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
                        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <input type="text" class="form-control" id="role" placeholder="Enter role" name="role">
                    </div>
                    <div class="form-group">
                        <label for="salary">Salary:</label>
                        <input type="text" class="form-control" id="salary" placeholder="Enter salary" name="salary">
                    </div>

                    <button type="submit" class="btn btn-primary">Add employee</button>
                </form>

                <br>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Salary</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->role}}</td>
                                <td>{{$employee->salary}}</td>
                                <td><a href="update-employee/{{$employee->id}}">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
