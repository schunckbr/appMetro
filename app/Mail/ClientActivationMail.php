<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Client;

class ClientActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function build()
    {
        // Gera a URL de ativação com o token do cliente
        $activationUrl = route('client.activate', ['token' => $this->client->activation_token]);

        return $this->subject('Ative sua conta')
            ->view('emails.activate-client')
            ->with(['activationUrl' => $activationUrl]);
    }
}
