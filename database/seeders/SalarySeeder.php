<?php 
use Illuminate\Database\Seeder;
use App\Models\Salary;

class SalarySeeder extends Seeder
{
    public function run()
    {
        Salary::create([
            'employee_id' => 1,
            'amount' => 5000.00,
            'pay_date' => '2023-01-31',
        ]);

        Salary::create([
            'employee_id' => 2,
            'amount' => 6000.00,
            'pay_date' => '2023-02-28',
        ]);
    }
}