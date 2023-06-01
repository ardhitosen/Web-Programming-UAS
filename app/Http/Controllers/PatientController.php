<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('patients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    public function login()
    {
        return view('patients.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|numeric',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $patient = new Patient();
        $patient->name = $request->name;
        $patient->email = $request->email;
        $patient->address = $request->address;
        $patient->phone_number = $request->phone;
        $patient->place_of_birth = $request->place_of_birth;
        $patient->date_of_birth = $request->date_of_birth;
        $patient->password = Hash::make($request->password);
        $patient->recovery_code = Str::random(10);
        $patient->save();

        return redirect()->route('patients.login')->with('success', 'Registration successful!')->with('recovery_code', $patient->recovery_code);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $patient = Patient::where('email', $credentials['email'])->first();

        if ($patient && Hash::check($credentials['password'], $patient->password)) {
            Auth::guard('patient')->login($patient);

            return redirect()->route('patients.dashboard', ['id' => $patient->id]);
        } else {
            return redirect()->back()->withErrors('Invalid credentials');
        }
    }

    public function dashboard($id)
    {
        $patient = Patient::findOrFail($id);
        if ($patient->id !== Auth::guard('patient')->id()) {
            return view('patients.index');
        }
        return view('patients.dashboard', compact('patient'));
    }
}
