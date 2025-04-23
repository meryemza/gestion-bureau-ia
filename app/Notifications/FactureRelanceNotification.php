<?php

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class FactureRelanceNotification extends Notification
{
    protected $facture;

    public function __construct($facture)
    {
        $this->facture = $facture;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    // Simule un message généré par une IA
    private function genererMessageIA()
    {
        $joursRestants = Carbon::parse($this->facture->date_echeance)->diffInDays(now(), false);

        if ($joursRestants < 0) {
            return "Nous vous rappelons que votre facture **n°{$this->facture->id}** d’un montant de **{$this->facture->montant} DH** arrive à échéance dans **" . abs($joursRestants) . " jours**. Merci de procéder au paiement à temps.";
        } elseif ($joursRestants === 0) {
            return "Votre facture **n°{$this->facture->id}** arrive à échéance **aujourd’hui**. Nous comptons sur votre réactivité.";
        } else {
            return "Votre facture **n°{$this->facture->id}** est en **retard de paiement depuis {$joursRestants} jours**. Merci de régulariser la situation dès que possible.";
        }
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("⏰ Relance facture n°{$this->facture->id}")
            ->greeting("Bonjour {$notifiable->nom},")
            ->line($this->genererMessageIA())
            ->action('Consulter ma facture', url("/factures/{$this->facture->id}/pdf"))
            ->salutation("Cordialement, L'équipe Comptabilité IA");
    }
}

