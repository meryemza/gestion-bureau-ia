<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'status',
        'reason',
        'type' ,
        'start_date',
    'end_date',
    ];
    
    public function employee()
    {
        return $this->belongsTo(Employe::class);
    }
}
