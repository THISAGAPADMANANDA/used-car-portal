<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $make
 * @property string $model
 * @property int $registration_year
 * @property float $price
 * @property string $description
 * @property string $image
 * @property string $status
 */
class Car extends Model
{
    protected $fillable = ['user_id', 'make', 'model', 'registration_year', 'price', 'description', 'image', 'status'];

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
