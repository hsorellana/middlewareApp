<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => '127.0.0.1:9000'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emp = new Employee();
        $emp->name = $request->name;
        $emp->rut = $request->rut;
        $emp->type = $request->type;
        $emp->save();

        $rutSplit = explode('-', $emp->rut);
        $type = ($emp->type == 'jefe') ? 1 : 2;

        $some = $this->client->request('POST', '/', [
            'form_params' => [
                'id' => $emp->id,
                'name' => $emp->name,
                'rut' => $rutSplit[0],
                'dv' => $rutSplit[1],
                'type_id' => $type
            ]
        ]);

        return redirect()->route('employee.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $emp = Employee::find($employee->id);
        return view('employee.edit')->with(compact('emp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $emp = Employee::find($employee->id);
        $emp->name = $request->name;
        $emp->rut = $request->rut;
        $emp->type = $request->type;
        $emp->save();

        $rutSplit = explode('-', $emp->rut);
        $type = ($emp->type == 'jefe') ? 1 : 2;

        $this->client->request('PUT', '/', [
            'form_params' => [
                'id' => $emp->id,
                'name' => $emp->name,
                'rut' => $rutSplit[0],
                'dv' => $rutSplit[1],
                'type_id' => $type
            ]
        ]);

        return redirect()->route('employee.create');
    }
}
