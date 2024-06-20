<?php

namespace WebDirectory\admin\core\domain\entities;
class Admins extends \Illuminate\Database\Eloquent\Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
}