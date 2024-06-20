<?php
namespace WebDirectory\admin\core\domain\entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Departments extends \Illuminate\Database\Eloquent\Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function entries(): BelongsToMany
    {
        return $this->belongsToMany(Entries::class, 'entry2departments', 'department_id', 'entry_id');
    }
}