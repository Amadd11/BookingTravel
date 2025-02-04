<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'proof',
        'quantitiy',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packageTour()
    {
        return $this->belongsTo(PackageTour::class);
    }

    public function packageBank()
    {
        return $this->belongsTo(PackageBank::class);
    }
}
