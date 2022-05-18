
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

    @if (count($companies)==0)
        <p>There is no Companies</p>
    @endif
    
    <nav class="navbar navbar-light bg-light">
        <div>
            <a class="btn btn-primary" href="{{route('company.create')}}">Create Company</a>
            <a class="btn btn-primary" href="{{route('employee.index')}}">Employees </a>
        </div>
        <form method="GET" action="{{route('company.search')}}">
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
            <th>Logo</th>
            <th>@sortablelink('name','Company name')</th>
            <th>@sortablelink('code','Code')</th>
            <th>@sortablelink('adress','Adress')</th>
            <th>@sortablelink('description','Description')</th>
            <th>@sortablelink('company_employee_count','Employees')</th>
            <th>Action</th>
        </tr>
        @foreach ($companies as $company)
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
                    <a class="btn btn-secondary" href="{{route('company.show', [$company])}}">Show</a>
                    <form method="post" action="{{route('company.destroy', [$company])}}">
                        @csrf
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!!$companies->appends(Request::except('page'))->render()!!}
</div>
@endsection