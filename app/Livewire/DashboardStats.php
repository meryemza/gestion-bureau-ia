<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardStats extends Component
{
    public $stats = [
        'activity_rate' => 20.6,
        'user_count' => 66,
        'sessions' => 11,
        'active_users' => 212,
    ];

    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}

