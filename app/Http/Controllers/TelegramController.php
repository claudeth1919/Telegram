<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Telegram\Bot\Laravel\Facades\Telegram;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class TelegramController extends Controller
{
  public function getHome()
    {
        return view('home');
    }

    public function getUpdates()
    {
        $updates = Telegram::getUpdates();
        dd($updates);
    }

    public function enviarNotificacionPushAdministrador($nombre)
    {
      $optionBuiler = new OptionsBuilder();
      $optionBuiler->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder('Un usuario necesita asistencia');
      $notificationBuilder->setBody($nombre)
      				    ->setSound('default');


      $option = $optionBuiler->build();
      $notification = $notificationBuilder->build();
      // $data = $dataBuilder->build();

      $token = "finWAZMaFeQ:APA91bFVOn8KrFjnl9IelhWId7KL449pIGZ8ey2dhjoUSyk2j72XODqF8r2AT1HUwdinqK7xwFSqmGj5eTYRMvjpXAWpJ1JiHQGV5af67aQ3yHa_Cbo1GonzAYbEaMAtiZXle5fLrFAD";

      $downstreamResponse = FCM::sendTo($token, $option, $notification);
      return "Éxito";

    }

    public function newMessage(Request $request){
        $entrada = $request->all();
        $mensaje = $entrada['message']['text'];
        $chatID = $entrada['message']['chat']['id'];
        $respuesta;

        switch ($mensaje) {
            case "/start":
                $respuesta="Te damos la bienvenida, gracias por usar nuestro bot universitario\n\n";
                $respuesta.="===Menú de ayuda\n\n";
                $respuesta.= "Si quieres saber la clave del internet escribe o dale clic a /internet\n\n";
                $respuesta.= "Si quieres saber la clave de los candados escribe o dale clic a /candado\n\n";
                $respuesta.= "Si necesita ayuda personalizada, estamos ubicados al lado de la máquina de dulces en el edificio A\n";
                $respuesta.= "Sino estuvieramos ahí entonces escribe o dale clic a /asistencia\n";
                break;
            case "/ayuda":
                $respuesta="===Menú de ayuda\n\n";
                $respuesta.= "Si quieres saber la clave del internet escribe o dale clic a /internet\n\n";
                $respuesta.= "Si quieres saber la clave de los candados escribe o dale clic a /candado\n\n";
                $respuesta.= "Si necesita ayuda personalizada, estamos ubicados al lado de la máquina de dulces en el edificio A\n";
                $respuesta.= "Sino estuvieramos ahí entonces escribe o dale clic a /asistencia\n";
                break;
            case "/internet":
                $respuesta = "La clave del internet es SomosAnahuac";
                break;
            case "/candado":
                $respuesta = "La clave del candado es 460";
                break;
            case "/asistencia":
                $nombre = $entrada['message']['chat']['first_name']." ".$entrada['message']['chat']['last_name'];
                $this->enviarNotificacionPushAdministrador($nombre);
                $respuesta = "Hemos recibido tu solicitud y nos pondremos en contacto contigo lo más pronto posible ".$nombre;
                break;
            default:
                $respuesta= "Por favor tiene que seleccionar una de las siguientes opciones\n\n";
                $respuesta.= "Si quieres saber la clave del internet escribe o dale clic a /internet\n\n";
                $respuesta.= "Si quieres saber la clave de los candados escribe o dale clic a /candado\n\n";
                $respuesta.= "Si necesita ayuda personalizada, estamos ubicados al lado de la máquina de dulces en el edificio A\n";
                $respuesta.= "Sino estuvieramos ahí entonces escribe o dale clic a /asistencia\n";
        }

        Telegram::sendMessage([
            'chat_id' => $chatID,
            'text' =>  $respuesta
        ]);
    }

    public function getMe()
    {
        $response = Telegram::getMe();
        return $response;
    }

    public function getSendMessage()
    {
        return view('send-message');
    }

    public function postSendMessage(Request $request)
    {
        $rules = [
            'message' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', 'Message is required');
        }

        Telegram::sendMessage([
            'chat_id' => 198060689,
            'text' => $request->get('message')
        ]);

        return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Message sent');
    }
}
