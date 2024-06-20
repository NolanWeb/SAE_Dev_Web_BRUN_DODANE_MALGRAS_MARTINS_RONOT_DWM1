<?php

namespace WebDirectory\admin\core\domain\entities;
class Entries extends \Illuminate\Database\Eloquent\Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    protected $table = 'entries';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Departments::class, 'entry2departments', 'entry_id', 'department_id');
    }
}