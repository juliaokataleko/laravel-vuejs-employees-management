<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeSingleResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(auth()->user()->can('show employees')) {
            activity()
                ->causedBy(auth()->user())
                //->performedOn($someContentModel)
                ->log('Access employes list');

            $query = Employee::query();

            if (request('search') and !empty(request('search'))) {
                $q = request('search');
                $query->where('first_name', 'like', "%$q%")
                    ->orWhere('middle_name', 'like', "%$q%")
                    ->orWhere('sallary', 'like', "%$q%")
                    ->orWhere('last_name', 'like', "%$q%");
            }

            if (request('department_id') and !empty(request('department_id'))) {
                $q = (int)request('department_id');
                $query->where('department_id', $q);
            }

            $employees = $query->get();
            return EmployeeResource::collection($employees);
            return response()->json($employees);
        } else {
            return response()->json([
                'warning' => 'Cannot acess this page'
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $this->rules($request);
        $employee = Employee::create($data);

        activity()
        ->causedBy(auth()->user())
            ->performedOn($employee)
            ->log('Store a employer');

        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        activity()
        ->causedBy(auth()->user())
            ->performedOn($employee)
            ->log('Acess the employer data');

        return new EmployeeSingleResource($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $this->rules($request);
        $employee->update($data);

        activity()
        ->causedBy(auth()->user())
            ->performedOn($employee)
            ->log('Update a employer');

        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        activity()
        ->causedBy(auth()->user())
            ->performedOn($employee)
            ->log('Delete a employer');

        $employee->delete();
        return response()->json("Deleted successful");
    }

    public function rules(Request $request)
    {
        return $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'department_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
            'sallary' => 'required',            
            'date_hired' => 'required',
            'birthdate' => 'required',
        ]);
    }
}
