<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Carbon\Carbon;

class CustomsDeclaration extends Model
{
    protected $primaryKey = 'cd_id';
    public $incrementing = false;
    protected $table = 'customs_declaration';
    protected $fillable = [
        'cd_id', 'cd_booking_id', 'cd_first_name', 'cd_last_name', 'cd_email', 'cd_date_of_birth', 'cd_occupation', 'cd_nationality', 'cd_passport_number', 'cd_address_in', 'cd_voyage_number', 'cd_arrival_date', 'cd_member', 'cd_number_baggage', 'cd_unaccompanied_baggage', 'cd_bring_animals', 'cd_bring_narcotics', 'cd_bring_currency', 'cd_bring_cigaretes', 'cd_bring_merchandise', 'cd_bring_goods', 'cd_status'
    ];

    public function customsGoods()
    {
        return $this->hasMany('App\CustomsDeclarationGoods', 'cd_id', 'cd_id')->select(['id', 'cd_id', 'goods_description', 'goods_quantity', 'goods_unit', 'goods_exchange_rate', 'goods_value']);
    }

    public function nationality()
    {
        return $this->belongsTo('App\TmCountry', 'cd_nationality', 'country_id')->select(['country_id', 'country_name']);
    }

    protected static function boot()
	{
		parent::boot();
		
		static::creating(function ($model) {
			try {
				$model->cd_id = Uuid::uuid4()->toString();
			} catch (UnsatisfiedDependencyException $e) {
				abort(500, $e->getMessage());
			}
		});
    }
    
    public function getFullNameAttribute()
    {
        return $this->attributes['cd_first_name'] . ' ' . $this->attributes['cd_last_name'];
    }

    public function getArrivalDateAttribute()
    {
        return Carbon::parse($this->attributes['cd_arrival_date'])->toRfc850String();
    }

    public function getDateOfBirthAttribute()
    {
        return Carbon::parse($this->attributes['cd_date_of_birth'])->toFormattedDateString();
    }
}
