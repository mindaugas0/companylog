@extends('layouts.app')

@section('content')
<div class="container">
    <h5>{{$company->name}} {{$company->code}}</h5>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Logo</th>
            <th>Company name</th>
            <th>Code</th>
            <th>Adress</th>
            <th>Description</th>
            <th>Employees</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>{{$company->id}}</td>
            <td>
                <a href="/images/{{$company->logo_src}}" target="_blank"><img src="/images/{{$company->logo_src}}" alt="{{$company->name}}" width="150" height="150"></a>
            </td>
            <td>{{$company->name}}</td>
            <td>{{$company->code}}</td>
            <td>{{$company->adress}}</td>
            <td>{{$company->description}}</td>
            <td>{{count($company->companyEmployee)}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('company.edit', [$company])}}">Edit</a>
                <form method="post" action="{{route('company.destroy', [$company])}}">
                    @csrf
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                <a class="btn btn-secondary" href="{{route('company.index')}}">Back</a>
            </td>
        </tr>
    </table>
    <h5>Employees</h5>
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
        @foreach ($employees->where('company_id', $company->id) as $employee)
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
                    <a class="btn btn-secondary" href="{{route('employee.show', [$employee])}}">Show</a>
                    <form method="post" action="{{route('employee.destroy', [$employee])}}">
                        @csrf
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection