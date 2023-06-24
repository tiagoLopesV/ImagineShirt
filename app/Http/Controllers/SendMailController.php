<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class SendMailController extends Controller
{
    public function send_mail(Request $request)
    {
        $data["email"] = $user->email;
        $data["title"] = "Confirmação de Encomenda";
        $data["body"] = "HELLO WORLD";
 
        $files = [
            public_path('attachments/test_image.jpeg'),
            public_path('attachments/test_pdf.pdf'),
        ];
  
        Mail::send($user, $data, function($message)use($data, $files) {
            $message->to($data["email"])
                    ->subject($data["title"]);
 
            foreach ($files as $file){
                $message->attach($file);
            }            
        });

        echo "Mail send successfully !!";
    }
}