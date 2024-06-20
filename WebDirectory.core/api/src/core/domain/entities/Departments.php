<?php

namespace WebDirectory\api\core\domain\entities;

class Departments extends \Illuminate\Database\Eloquent\Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}