<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentage',
    ];

    public function discountable(): MorphTo
    {
        return $this->morphTo('discountable');
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->discountable->isOwnedBy($user);
    }
}
