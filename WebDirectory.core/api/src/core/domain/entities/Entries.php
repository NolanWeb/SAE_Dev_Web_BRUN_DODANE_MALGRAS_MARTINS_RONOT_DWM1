<?php

namespace WebDirectory\api\core\domain\entities;

class Entries extends \Illuminate\Database\Eloquent\Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    protected $table = 'entries';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}