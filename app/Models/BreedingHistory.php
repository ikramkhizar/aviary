<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BreedingHistory extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'breeding_histories';

    protected $dates = [
        'lay_date',
        'hatch_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'clutch_no',
        'egg_type_id',
        'lay_date',
        'hatch_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function egg_type()
    {
        return $this->belongsTo(Egg::class, 'egg_type_id');
    }

    public function getLayDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLayDateAttribute($value)
    {
        $this->attributes['lay_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getHatchDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setHatchDateAttribute($value)
    {
        $this->attributes['hatch_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
