@extends('layouts.app')

@section('content')
<div class="container">
    <h5>{{$employee->name}} {{$employee->surname}}</h5>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Birthday</th>
            <th>Details</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>{{$employee->id}}</td>
            <td>
                <a href="/images/{{$employee->user_photo}}" target="_blank"><img src="/images/{{$employee->user_photo}}" alt="{{$employee->name}} {{$employee->surname}}" width="150" height="150"></a>
            </td>
            <td>{{$employee->name}}</td>
            <td>{{$employee->surname}}</td>
            <td>{{$employee->birthday}}</td>
            <td>{{$employee->details}}</td>
            <td>{{$employee->Company->name}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('employee.edit', [$employee])}}">Edit</a>
                <form method="post" action="{{route('employee.destroy', [$employee])}}">
                    @csrf
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                <a class="btn btn-secondary" href="{{route('employee.index')}}">Back</a>
            </td>
        </tr>
    </table>
</div>
@endsection