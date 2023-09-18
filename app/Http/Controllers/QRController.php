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

        //$apprentice = $data->Nombre . ' ' . $data->Apellido;

        $name = "Asistio con el QR";
        $code = rand(10000, 99999);

        date_default_timezone_set('America/Bogota');
        $currentTime = date('H:i:s');

        $dataUser = User::find($dataAjax[0]);
        $nameFull = $dataUser->first_name . ' ' . $dataUser->last_name;


        //Compruebo si los dos campos son vacios
        if (empty($dataAjax[1] && $dataAjax[2])) {
            //si son vacios me pone la hora actual
            $startTime = $currentTime;
            $endTime = $currentTime;
            //si un campo tiene algo, si tiene valor me pone la hora
        } elseif (!empty($dataAjax[1])) {
            $startTime = $dataAjax[1];
            $endTime = $currentTime;
        } else {
            $startTime = $currentTime;
            $endTime = $dataAjax[2];
        }

        $attendance = Asistencia::create([
            'code_attendance' => $code,
            'name_attendance' => $name,
            'admission_time' => $startTime,
            'apprentices_assisted' => $nameFull,
            'exit_time' => $endTime
        ]);

        if ($attendance) {
            echo "si";
        } else {
            echo "no";
        }
    }

}
