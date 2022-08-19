<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeM;
use App\Models\CompaniesM;
use Auth;

class EmployeeC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $employees = EmployeeM::latest()->paginate(5);
        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = CompaniesM::all();
        return view('employees.create', compact('companies'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'company_id' => 'required',
            'phone' => 'required',
        ]);
    
        $employee = new EmployeeM();
        $employee->firstName = $request->firstName;
        $employee->lastName = $request->lastName;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();
    
        return redirect()->route('employees.index')
                        ->with('success','Employee created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeM  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeM $employee)
    {
        $companies = CompaniesM::all();
        return view('employees.show',compact('employee','companies'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeM  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeM $employee)
    {
        $companies = CompaniesM::all();
        return view('employees.edit',compact('employee','companies'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeM  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeM $employee)
    {
         request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'company_id' => 'required',
            'phone' => 'required',
        ]);
    
        $employee->firstName = $request->firstName;
        $employee->lastName = $request->lastName;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();
    
        return redirect()->route('employees.index')
                        ->with('success','Employee updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeM  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeM $employee)
    {
        $employee->delete();
    
        return redirect()->route('employees.index')
                        ->with('success','Employee deleted successfully');
    }
}