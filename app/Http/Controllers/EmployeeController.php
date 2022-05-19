<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\company;
use App\Http\Requests\StoreemployeeRequest;
use App\Http\Requests\UpdateemployeeRequest;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::sortable()->paginate(10);
        // dd($employees);
        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select_values = company::all();
        return view('employees.create', ['select_values' => $select_values]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreemployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "user_photo" => "required|file|max:514",
            "name" => "required|alpha|min:3|max:15",
            "surname" => "required|alpha|min:3|max:15",
            "birthday" => "required|date",
            "details" => "required|min:20|max:500",
            "company_id" => "required"
        ]);

        $employee = new Employee;

        $employee->user_photo = $request->user_photo;
        $imageName = 'image' . time() . '.' . $request->user_photo->extension();
        $request->user_photo->move(public_path('images'), $imageName);
        $employee->user_photo = $imageName;

        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->birthday = $request->birthday;
        $employee->details = $request->details;
        $employee->company_id = $request->company_id;

        $employee->save();
        return redirect()->route('employee.index')->with('success_message', 'New employee successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        return view('employees.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
        $select_values = company::all();
        return view('employees.edit', ['employee' => $employee, 'select_values' => $select_values]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateemployeeRequest  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee $employee)
    {
        $request->validate([
            "user_photo" => "required|file|max:514",
            "name" => "required|alpha|min:3|max:15",
            "surname" => "required|alpha|min:3|max:15",
            "birthday" => "required|date",
            "details" => "required|min:20|max:500",
            "company_id" => "required"
        ]);

        if ($request->has('user_photo')) {
            $employee->user_photo = $request->user_photo;
            $imageName = 'image' . time() . '.' . $request->user_photo->extension();
            $request->user_photo->move(public_path('images'), $imageName);
            $employee->user_photo = $imageName;
        }

        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->birthday = $request->birthday;
        $employee->details = $request->details;
        $employee->company_id = $request->company_id;

        $employee->save();
        return redirect()->route('employee.index')->with('success_message', 'Employee successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success_message', 'Successfully deleted');
    }

    public function employeeSearch(Request $request)
    {
        $search_input = $request->search_input;
        $employees = employee::where('name', 'LIKE', '%' . $search_input . '%')
            ->orWhere('surname', 'LIKE', '%' . $search_input . '%')
            ->orWhere('birthday', 'LIKE', '%' . $search_input . '%')
            ->orWhere('company_id', 'LIKE', '%' . $search_input . '%')
            ->orWhere('details', 'LIKE', '%' . $search_input . '%')
            ->orWhereHas('company', function ($query) use ($search_input) {
                $query->where('company_name', 'like', '%' . $search_input . '%');
            })
            ->sortable()
            ->paginate(10)
            ->appends(request()->query());

        return view('employees.search', ['search_input' => $search_input, 'employees' => $employees]);
    }
}
