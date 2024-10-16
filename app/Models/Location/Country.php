<?php
 namespace App\Models\Location;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	protected $table = 'ar_countries';
	protected $casts = ['status' => Status::class];
	protected $fillable = ['fips', 'iso', 'domain', 'fa_name', 'en_name', 'status'];

}
