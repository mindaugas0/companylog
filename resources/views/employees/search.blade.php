
@extends('layouts.app')

@section('content')
<div class="container">

    @if (count($employees)==0)
    <div class="alert alert-success ">
        <p>There is no Employees</p>
    </div>
    @endif

    <nav class="navbar navbar-light bg-light">
        <div>
            <a class="btn btn-primary" href="{{route('employee.index')}}">Back to Index</a>
        </div>
    </nav>

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>@sortablelink('name', 'Name')</th>
            <th>@sortablelink('surname', 'Surname')</th>
            <th>@sortablelink('birthday', 'Birthday')</th>
            <th>@sortablelink('details', 'Details')</th>
            <th>@sortablelink('Company.company_name', 'Company')</th>
            <th>Action</th>
        </tr>
        @foreach ($employees as $employee)
            <tr>
                <td>{{$employee->id}}</td>
                <td>
                    <a href="/images/{{$employee->user_photo}}" target="_blank"><img src="/images/{{$employee->user_photo}}" alt="{{$employee->name}} {{$employee->surname}}" width="150" height="150"></a>
                </td>
                <td>{{$employee->name}}</td>
                <td>{{$employee->surname}}</td>
                <td>{{$employee->birthday}}</td>
                <td>{{$employee->details}}</td>
                <td>{{$employee->Company->company_name}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('employee.edit', [$employee])}}">Edit</a>
                    <a class="btn btn-secondary" href="{{route('employee.show', [$employee])}}">Show</a>
                    <form method="post" action="{{route('employee.destroy', [$employee])}}">
                        @csrf
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!!$employees->appends(Request::except('page'))->render()!!}
</div>
@endsection