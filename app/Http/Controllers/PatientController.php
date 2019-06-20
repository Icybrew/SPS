<?php

namespace SPS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

use SPS\User;
use SPS\Patient;
use SPS\ExtraInfoPatient;
use SPS\Role;

class PatientController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('search')) {

            $patients = User::select('users.*')->whereHas('roles', function ($q) { $q->where('name', '=', config('roles.name.patient')); })
                    ->leftJoin('extra_info_patient', 'users.id', '=', 'extra_info_patient.patient_id')
                    ->where(function ($q) use ($request) {
                        $q->where('firstname', 'LIKE', "%{$request->search}%");
                        $q->orWhere('lastname', 'LIKE', "%{$request->search}%");
                        $q->orWhere('ssn', 'LIKE', "%{$request->search}%");
                    })
                    ->orderBy('users.id', 'desc')
                    ->paginate();

            $patients->appends(['search' => $request->search]);

            return view('patients.index', compact('patients'));
        } else {
            // Getting all users with patient role
            $patients = User::whereHas('roles', function ($q) { $q->where('name', '=', config('roles.name.patient')); })->orderBy('users.id', 'desc')->paginate();

            return view('patients.index', compact('patients'));
        }


        // Getting all users with patient role
        $patients = Role::where('name', '=', config('roles.name.patient'))->first()->users()->orderBy('created_at', 'desc')->paginate();

        return view('patients.index', compact('patients'));
    }

    public function show($id)
    {
        // Getting user with extraInfoPatient who has patient role
        $patient = User::with('extraInfoPatient')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.patient'));
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('view', $patient);

        return view('patients.patient', compact('patient'));
    }

    public function search(Request $request)
    {
        
        $request->validate([
            'search' => 'sometimes|required|numeric|digits:11'
        ]);
        
        if ($request->has('search')) {
            $patients = User::select('users.*')->whereHas('roles', function ($q) { $q->where('name', '=', config('roles.name.patient')); })
                    ->leftJoin('extra_info_patient', 'users.id', '=', 'extra_info_patient.patient_id')
                    ->where(function ($q) use ($request) {
                        $q->Where('extra_info_patient.ssn', 'LIKE', "%{$request->search}%");
                    })
                    ->paginate();

            return view('patients.search', compact('patients'));
        } else {
            return view('patients.search');
        }
    }

    public function myPatients(Request $request)
    {

        if ($request->has('search')) {
            $patients = Auth::user()->patients()->with('extraInfoPatient')
                    ->leftJoin('extra_info_patient', 'users.id', '=', 'extra_info_patient.patient_id')
                    ->where(function ($q) use ($request) {
                        $q->where('firstname', 'LIKE', "%{$request->search}%");
                        $q->orWhere('lastname', 'LIKE', "%{$request->search}%");
                        $q->orWhere('ssn', 'LIKE', "%{$request->search}%");
                    })
                    ->orderBy('users.id', 'desc')
                    ->paginate();

            $patients->appends(['search' => $request->search]);

            return view('patients.my-patients.index', compact('patients'));
        } else {
            $patients = Auth::user()->patients()->with('extraInfoPatient')->orderBy('users.id', 'desc')->paginate();
            return view('patients.my-patients.index', compact('patients'));
        }
    }
   
    public function myPatientsExport()
    {
        // Getting current users patient list
        $patients = Auth::user()->patients()->with('extraInfoPatient')->paginate();

        // Validating if user has atleast 1 patient
        if ($patients->count() > 0) {

            // File name to save as
            $fileName = 'patientInfoExports.txt';

            // Deleting old file if exists.
            if (file_exists($fileName)) {
                unlink($fileName);
            }

            $file = fopen($fileName, 'a');
            $format = '%s, %s, %s, %s'; // Firstname, Lastname, SSN, Birthday

            foreach ($patients as $patient)
            {
                fwrite($file, sprintf($format, $patient->firstname, $patient->lastname, (!empty($patient->extraInfoPatient->ssn) ? $patient->extraInfoPatient->ssn : 'SSN not specified'), (!empty($patient->birthday) ? $patient->birthday : 'Birthday not specified')) . PHP_EOL);
            }

            // Closing file
            fclose($file);

            return response()->download($fileName);
        } else {
            return redirect()->back()->withErrors(new MessageBag(['export' => "You have 0 patients"]));
        }
    }
    
}
