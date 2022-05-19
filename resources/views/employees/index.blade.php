
@extends('layouts.app')

@section('content')
<div class="container">

    @if(session()->has('error_message'))
        <div class="alert alert-danger">
            {{session()->get('error_message')}}
        </div>
    @endif

    @if(session()->has('success_message'))
        <div class="alert alert-success ">
            {{session()->get('success_message')}}
        </div>
    @endif

    @if (count($employees)==0)
        <p>There is no Employees</p>
    @endif

    <nav class="navbar navbar-light bg-light">
        <div>
            <a class="btn btn-primary" href="{{route('employee.create')}}">New Employee</a>
            <a class="btn btn-primary" href="{{route('company.index')}}">Companies </a>
        </div>
        <form method="GET" action="{{route('employee.search')}}">
            @csrf
            <div class="input-group">
                <input type="search" name="search_input" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button type="submit" class="btn btn-outline-primary">search</button>
            </div>
        </form>
    </nav>

    <table class="table table-striped">
        <tr>
            <th>@sortablelink('id', 'ID')</th>
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