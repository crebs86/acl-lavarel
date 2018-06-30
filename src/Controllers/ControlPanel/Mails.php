<?php

namespace Crebs86\Acl\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class Mails extends Controller
{
    private $to = [];
    private $from = "";
    private $params = [];
    private $subject="";
    private $redirect="";

    /**
     * @param array $to
     * @param string $from
     * @param string $view
     * @param string $subject
     * @param string $redirect
     * @param array $params
     * @return view registration
     */
    private function sendEmail(array $to, string $from,string $view, string $subject, string $redirect="", array $params){
        $this->to = $to;
        $this->from = $from;
        $this->subject = $subject;
        $this->redirect = $redirect;
        $this->params = $params;
        Mail::send($view, $this->params, function ($mail){
            $mail->to($this->to);
            $mail->from($this->from);
            $mail->subject($this->subject);
        });
        return view($this->redirect);
    }


    /**
     * @param $mailTo
     * @param $token
     * @return view
     */
    public function confirmMail($mailTo, $token){
        return $this->sendEmail([$mailTo], env('MAIL_FROM_REGISTER'),'control_panel.mail.confirmmail', 'Registration Confirmation Email to '. env('APP_NAME'), 'control_panel.user.message.registered',  ['token'=>$token]);
    }
}
