<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Employe; // si ton modèle employé s'appelle Employee

class ServiceEmployeeSeeder extends Seeder
{
    public function run()
    {
        $services = [
            'Informatique',
            'Ressources Humaines',
            'Comptabilité',
            'Marketing'
        ];

        foreach ($services as $serviceName) {
            $service = Service::create([
                'nom' => $serviceName,
                'prix_ttc' => 0, 
            ]);

            // On ajoute quelques employés pour chaque service
            Employe::create([
                'name' => 'Alice ' . $serviceName,
                'service_id' => $service->id,

            ]);

            Employe::create([
                'name' => 'Bob ' . $serviceName,
                'service_id' => $service->id,
            ]);
        }
    }
}
