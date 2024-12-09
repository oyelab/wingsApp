<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

	protected $fillable = [
        'email',
        'status',
        'message',
        'continent',
        'continent_code',
        'country',
        'country_code',
        'region',
        'region_name',
        'city',
        'district',
        'zip',
        'lat',
        'lon',
        'timezone',
        'offset',
        'currency',
        'isp',
        'org',
        'as',
        'asname',
        'reverse',
        'mobile',
        'proxy',
        'hosting',
        'query',
        'ip_address',
        'user_agent',
        'device',
        'platform',
        'browser',
    ];

}
