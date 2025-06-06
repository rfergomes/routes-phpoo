<?php

namespace app\controllers;

use app\support\Email;
use app\support\Flash;
use app\support\Validate;

class ContactController extends Controller
{
    public function index()
    {
        $this->view('contact', ['title' => 'Contact']);
    }

    public function store()
    {
        $validate = new Validate;
        
        $validated = $validate->validate([
            'name' => 'required',
            'phone' => 'optional',
            'email' => 'email|required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        
        if (!$validated) {
            return redirect('/contact');
        }

        $email = new Email;
        $sent = $email->from($validated['email'], $validated['name'])
        ->to(env('EMAIL_SEND_TO'))
        ->message($validated['message'])
        ->template('contact', [
            'name' => env('EMAIL_SEND_NAME'),
            'fromName' => env('EMAIL_SEND_TO_NAME') ,
            'fromEmail' => $validated['email'],
            'fromPhone' => $validated['phone'],
            'fromMessage' => $validated['message']
            ])
        ->subject($validated['subject'])
        ->send();

        if ($sent) {
            Flash::set('sent_success', 'Email enviado com sucesso');
            return redirect('/contact');
        }
        
        Flash::set('sent_error', 'Ocorreu um erro ao enviar o email');
        return redirect('/contact');
    }
}
