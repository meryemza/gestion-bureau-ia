<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Facture;
use App\Notifications\FactureRelanceNotification;

class RelanceFactures extends Command
{
    protected $signature = 'factures:relancer';
    protected $description = 'Envoie automatique des relances de factures en attente ou en retard';

    public function handle()
    {
        $factures = Facture::with('client')->where('statut', 'en attente')->get();

        foreach ($factures as $facture) {
            if ($facture->client && $facture->client->email) {
                $facture->client->notify(new FactureRelanceNotification($facture));
            }
        }

        $this->info("Relances envoyées avec succès !");
    }
}
