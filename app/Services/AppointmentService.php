<?php

namespace App\Services;


use App\Exceptions\AppointmentCreateException;
use App\Exceptions\AppointmentUpdateException;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Models\Appointment;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentService
{
    public function create(AppointmentStoreRequest $request): void
    {

        try {
            DB::beginTransaction();

            $from = $request->dateFrom.' '.$request->timeFrom;
            $to = $request->dateTo.' '.$request->timeTo;

            Appointment::create([
                'user_id' => $request->user_id,
                'from' => $from,
                'to' => $to,
                'title' => $request->title
            ]);

            smilify('success', 'Appuntamento creato correttamente');
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('appuntamento non creato', [$e->getMessage()]);
            throw new AppointmentCreateException();
        }
    }

    public function update(AppointmentUpdateRequest $request, string $id): void
    {

        try {
            DB::beginTransaction();

            $appointment = Appointment::findOrFail($id);

            $from = $request->dateFrom.' '.$request->timeFrom;
            $to = $request->dateTo.' '.$request->timeTo;

            $appointment->update([
                'user_id' => $request->user_id,
                'from' => $from,
                'to' => $to,
                'title' => $request->title
            ]);

            smilify('success', 'Appuntamento modificato correttamente');
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('appuntamento non modificato', [$e->getMessage()]);
            throw new AppointmentUpdateException();
        }
    }

}
