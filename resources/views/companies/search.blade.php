
@extends('layouts.app')

@section('content')

<div class="container">
    
    @if (count($companies)==0)
        <div class="alert alert-success">
            <p>There is no Companies</p>
        </div>
    @endif
    
    <nav class="navbar navbar-light bg-light">
        <div>
            <a class="btn btn-primary" href="{{route('company.index')}}">Back to Index</a>
        </div>
    </nav>

    <table class="table table-striped">
        <tr>
            <th>@sortablelink('id', 'ID')</th>
            <th>Logo</th>
            <th>@sortablelink('company_name','Company name')</th>
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
                    <a href="/images/{{$company->logo_src}}" target="_blank"><img src="/images/{{$company->logo_src}}" alt="{{$company->company_name}}" width="150" height="150"></a>
                </td>
                <td>{{$company->company_name}}</td>
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