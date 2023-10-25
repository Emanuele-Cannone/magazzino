<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Models\Appointment;
use App\Services\AppointmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->service = new AppointmentService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $appointments = Appointment::where('from', '>', Carbon::now()->subMonth(4))
            ->get()
            ->mapWithKeys( function (object $appointment, int $key) {
                return [
                    $key => [
                        'id' => $appointment->id,
                        'title' => $appointment->title,
                        'description' => $appointment->description,
                        'start' => $appointment->from,
                        'end' => $appointment->to,
                        'color' => 'green' // qui controllo la timbratura
                    ]
                ];
            });

        return view('appointments.index', ['appointments' => $appointments]);
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
    public function store(AppointmentStoreRequest $request)
    {
        $this->service->create($request);

        return Redirect::route('appointments.index');
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
    public function update(AppointmentUpdateRequest $request, string $id)
    {
        $this->service->update($request, $id);

        return Redirect::route('appointments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->delete();

        smilify('success', 'Appuntamento eliminato correttamente');

        return Redirect::route('appointments.index');
    }
}
