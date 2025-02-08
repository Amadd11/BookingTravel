<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'proof',
        'quantity',
        'total_amount',
        'insurance',
        'tax',
        'sub_total',
        'is_paid',
        'start_date',
        'end_date',
        'user_id',
        'package_tour_id',
        'package_bank_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function packageTour()
    {
        return $this->belongsTo(PackageTour::class, 'package_tour_id');
    }

    public function packageBank()
    {
        return $this->belongsTo(PackageBank::class);
    }
}
