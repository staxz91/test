<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProxyTest extends Model
{
    public $timestamps = true;

    /** @var string */
    protected $table = 'proxy_test';

    /** @var array */
    protected $fillable = [
        'ip_address',
        'port',
        'username',
        'password',
        'url',
        'status'
    ];

    /** @var array */
    protected $visible = [
        'id',
        'ip_address',
        'port',
        'username',
        'password',
        'url',
        'status'
    ];
}
