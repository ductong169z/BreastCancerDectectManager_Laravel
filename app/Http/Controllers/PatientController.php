<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PatientController extends Controller
{
    /**
     * Display all patients
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patient=$request->patient;
        $patients = Patient::latest();
        if($patients){
            $patients = $patients->where('patients.name', 'LIKE', '%' . $patient . '%');
        }
        $patients = $patients->paginate(10);
        return view('patients.index', compact('patients', 'patient'));
    }


    /**
     * Show form for creating patient
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created user
     *
     * @param Patient $patient
     * @param StorePatientRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Patients $patient, StorePatientRequest $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $patient->create(array_merge($request->validated(), [
            'password' => 'test'
        ]));

        return redirect()->route('patients.index')
            ->withSuccess(__('Patient created successfully.'));
    }

    /**
     * Show patients data
     *
     * @param Patient $patient
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Patients $patient)
    {
        return view('patients.show', [
            'patient' => $patient
        ]);
    }

    /**
     * Edit Patient data
     *
     * @param Patient $patient
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', [
            'patient' => $patient,
//            'userRole' => $patient->roles->pluck('name')->toArray(),
//            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update patient data
     *
     * @param Patient $patient
     * @param UpdatePatientRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Patients $patient, UpdatePatientRequest $request)
    {
        $patient->update($request->validated());

//        $patient->syncRoles($request->get('role'));

        return redirect()->route('patients.index')
            ->withSuccess(__('Patient updated successfully.'));
    }

    /**
     * Delete Patient data
     *
     * @param Patient $patient
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
            ->withSuccess(__('Patient deleted successfully.'));
    }
}
