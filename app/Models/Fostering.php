<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fostering extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'fosterings';

    protected $dates = [
        'foster_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'breeding_history_id',
        'pair_id',
        'egg_type_id',
        'foster_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function breeding_history()
    {
        return $this->belongsTo(BreedingHistory::class, 'breeding_history_id');
    }

    public function pair()
    {
        return $this->belongsTo(BreedingPair::class, 'pair_id');
    }

    public function egg_type()
    {
        return $this->belongsTo(Egg::class, 'egg_type_id');
    }

    public function getFosterDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFosterDateAttribute($value)
    {
        $this->attributes['foster_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
