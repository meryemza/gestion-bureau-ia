<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RhController extends Controller
{
    public function index()
{
    return view('dashboard.rh', [
        'totalSalary' => 4490000,
        'averageSalary' => 35635,
        'turnoverRate' => '1.1%',
        'absenteeism' => '1.1%',
        'avgAge' => 42,
        'permanentRate' => '88%',
        'headcount' => 126,
        'hired' => 6,
        'left' => 17,
        'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        'genderM' => [75, 74, 76, 75, 73, 75],
        'genderF' => [55, 56, 54, 53, 52, 51],
        'salaryPerMonth' => [750000, 730000, 740000, 755000, 720000, 750000],
        'hiredPerMonth' => [5, 6, 4, 7, 3, 6],
        'leftPerMonth' => [2, 3, 5, 4, 6, 5],
        'headcountData' => [60, 66],
    ]);
}

    public function conges()
    {
        // Fetch leave requests (congés) from the database
        $conges = conges::with('user')->latest()->get();
        return view('rh.conges', compact('conges'));
    }
}