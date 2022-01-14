<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BreedingPair extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'breeding_pairs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'male_bird_id',
        'female_bird_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function male_bird()
    {
        return $this->belongsTo(UserBird::class, 'male_bird_id');
    }

    public function female_bird()
    {
        return $this->belongsTo(UserBird::class, 'female_bird_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
