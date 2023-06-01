<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'name' => 'required',
        'doctor_photo' => 'required|image',
        'type' => 'required|in:Dokter Spesialis,Dokter Umum',
        'schedules.*' => 'required|date_format:Y-m-d\TH:i',
    ]);

    $path = null;
    $ext = null;

    if ($request->hasFile('doctor_photo')) {
        $path = $request->file('doctor_photo')->storePublicly('images', 'public');
        $ext = $request->file('doctor_photo')->extension();
    }

    $doctor = new Doctor();
    $doctor->name = $validatedData['name'];
    $doctor->doctor_photo = $path;
    $doctor->type = $validatedData['type'];
    $doctor->schedule = json_encode($validatedData['schedules']);
    $doctor->save();

    return redirect()->route('admins.doctors');
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
        $doctor = Doctor::findOrFail($id);
        $doctor->schedule = json_decode($doctor->schedule, true);
        return view('admins.doctoredit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'doctor_photo' => 'required|image',
            'type' => 'required|in:Dokter Spesialis,Dokter Umum',
            'schedules.*' => 'required|date_format:Y-m-d\TH:i',
        ]);
    
        $path = null;
        $ext = null;
    
        if ($request->hasFile('doctor_photo')) {
            $path = $request->file('doctor_photo')->storePublicly('images', 'public');
            $ext = $request->file('doctor_photo')->extension();
        }
    
        $doctor = Doctor::findOrFail($id);
        $doctor->name = $validatedData['name'];
        $doctor->doctor_photo = $path;
        $doctor->type = $validatedData['type'];
        $doctor->schedule = json_encode($validatedData['schedules']);
        $doctor->save();
    
        return redirect()->route('admins.doctors');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('admins.doctors');
    }
}
