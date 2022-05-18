<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\employee;
use App\Http\Requests\StorecompanyRequest;
use App\Http\Requests\UpdatecompanyRequest;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::withCount('companyEmployee')->sortable()->paginate(10);
        // dd($companies);
        return view('companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "logo_src" => "required|file|max:514",
            "name" => "required|alpha|min:3|max:30",
            "code" => "required|numeric|digits:9",
            "adress" => "required|min:15|max:50",
            "description" => "required|min:20|max:500"
        ]);

        $company = new Company;

        $company->logo_src = $request->logo_src;
        $imageName = 'image' . time() . '.' . $request->logo_src->extension();
        $request->logo_src->move(public_path('images'), $imageName);
        $company->logo_src = $imageName;

        $company->name = $request->name;
        $company->code = $request->code;
        $company->adress = $request->adress;
        $company->description = $request->description;

        $company->save();
        return redirect()->route('company.index')->with('success_message', 'Company successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        $employees = employee::all();
        return view('companies.show', ['company' => $company, 'employees' => $employees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecompanyRequest  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, company $company)
    {
        $request->validate([
            "logo_src" => "required|file|max:514",
            "name" => "required|alpha|min:3|max:30",
            "code" => "required|numeric|digits:9",
            "adress" => "required|min:15|max:50",
            "description" => "required|min:20|max:500"
        ]);

        if ($request->has('logo_src')) {
            $company->logo_src = $request->logo_src;
            $imageName = 'image' . time() . '.' . $request->logo_src->extension();
            $request->logo_src->move(public_path('images'), $imageName);
            $company->logo_src = $imageName;
        }

        $company->name = $request->name;
        $company->code = $request->code;
        $company->adress = $request->adress;
        $company->description = $request->description;

        $company->save();
        return redirect()->route('company.index')->with('success_message', 'Company successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(company $company)
    {
        $employees = $company->companyEmployee;

        if (count($employees) != 0) {
            return redirect()->route('company.index')->with('error_message', 'Delete is not possible because company has employees');
        }

        $company->delete();
        return redirect()->route('company.index')->with('success_message', 'Successfully deleted');
    }

    public function companySearch(Request $request)
    {
        $search_input = $request->search_input;
        $companies = company::where('name', 'LIKE', '%' . $search_input . '%')
            ->orWhere('code', 'LIKE', '%' . $search_input . '%')
            ->orWhere('adress', 'LIKE', '%' . $search_input . '%')
            ->orWhere('description', 'LIKE', '%' . $search_input . '%')
            ->withCount('companyEmployee')
            ->sortable()
            ->paginate(10)
            ->appends(request()->query());

        return view('companies.search', ['search_input' => $search_input, 'companies' => $companies]);
    }
}
