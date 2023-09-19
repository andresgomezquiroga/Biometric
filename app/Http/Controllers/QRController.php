<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use BaconQrCode\Encoder\QrCode as EncoderQrCode;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class QRController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Obtener el usuario autenticado
        return view('qr.generate', compact('user'));
    }

    public function addDateByCodigoQr(Request $request)
    {
        $dataAjax = $request->input('qr_data');
    
        $name = "Asistió con el QR";
        $code = rand(10000, 99999);
    
        date_default_timezone_set('America/Bogota');
        $currentTime = date('H:i:s');
    
        $dataUser = User::find($dataAjax[0]);
        $nameFull = $dataUser->first_name . ' ' . $dataUser->last_name;
    
        $existingAttendance = Asistencia::where('apprentices_assisted', $nameFull)->first();
    
        if ($existingAttendance) {
            // Ya existe una entrada de asistencia para el aprendiz
            if (empty($existingAttendance->admission_time)) {
                // Si la "hora de inicio" está vacía, la establecemos
                $existingAttendance->admission_time = $currentTime;
            } elseif (empty($existingAttendance->exit_time)) {
                // Si la "hora de inicio" ya está registrada pero la "hora de finalización" está vacía, la establecemos
                $existingAttendance->exit_time = $currentTime;
            } else {
                // Ambos campos ya están ocupados, puedes manejarlo de la manera que desees
                return response()->with('error', 'Ya existe una asistencia registrada.');
            }
    
            // Guardamos los cambios en la entrada de asistencia existente (si existe)
            $existingAttendance->save();
        } else {
            // No existe una entrada previa, registramos solo la "hora de inicio"
            $attendance = Asistencia::create([
                'code_attendance' => $code,
                'name_attendance' => $name,
                'admission_time' => $currentTime,
                'apprentices_assisted' => $nameFull,
            ]);
    
            if (!$attendance) {
                return response()->with('error', 'No se pudo registrar la asistencia.');
            }
        }
    
        return response(['message' => 'success']);
    }

}