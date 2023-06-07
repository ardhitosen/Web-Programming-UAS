<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use App\Models\Doctor;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('doctor', 'patient')->get();
        // ->where('status', 'Waiting Approval')
        return view('admins.reservations',compact('reservations'));
    }

    public function viewReservePatient($id)
    {
        $patient = Patient::find($id);
        $reservations = Reservation::where('patient_id', $id)
        ->with('doctor', 'patient')
        ->get();
        // ->where('status', 'Waiting Approval')
        return view('patients.profile',compact('reservations', 'patient'));
    }

    public function approve(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'Approved';
        $reservation->save();

        return redirect()->route('admins.reservations');
    }

    public function decline(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'Declined';
        $reservation->save();

        return redirect()->route('admins.reservations');
    }

    public function leaveReview(Request $request)
    {
        $patient = Patient::findorfail($request->patient_id);
        $doctor = Doctor::findorfail($request->doctor_id);
        $validator = Validator::make($request->all(), [
            'review' => 'required',
         ]);
         
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
         }

        $reservation = Reservation::findOrFail($request->reservation_id);
        $reservation->review = $request->review;
        $reservation->save();
        
        $doctor = Doctor::findOrFail($request->doctor_id);
        $reservations = Reservation::where('doctor_id',$request->doctor_id)->get();
        $patient = Patient::findOrFail($request->patient_id);
        $review = Reservation::where([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'review' => null
        ])->first();
        return view('patients.doctorview', compact('patient','doctor','reservations','review'));
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
        //
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
}
