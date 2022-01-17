<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBird extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public const GENDER_RADIO = [
        '1' => 'Male',
        '2' => 'Female',
        '0' => 'Unknown',
    ];

    public $table = 'user_birds';

    protected $dates = [
        'dob',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'mutation_name',
        'specie_id',
        'ring_no',
        'gender',
        'male_parent',
        'female_parent',
        'dob',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
        'breeding_history_id',
        'created_by_id',
    ];

    public function breeding_history()
    {
        return $this->belongsTo(BreedingHistory::class, 'breeding_history_id', 'id');
    }

    public function maleBirdBreedingPairs()
    {
        return $this->hasMany(BreedingPair::class, 'male_bird_id', 'id');
    }

    public function femaleBirdBreedingPairs()
    {
        return $this->hasMany(BreedingPair::class, 'female_bird_id', 'id');
    }

    public function specie()
    {
        return $this->belongsTo(Specie::class, 'specie_id');
    }

    public function getMutationFullNameAttribute()
    {
        return $this->mutation_name ? ($this->ring_no ? $this->mutation_name.' ('.$this->ring_no.')' : $this->mutation_name) : null;
    }

    public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
