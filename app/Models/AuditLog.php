<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditLog extends Model
{
    use HasFactory;

    protected $table = 'audit_logs';

    protected $fillable = [
        'table_name',
        'record_id',
        'action',
        'old_value',
        'new_value',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk mendapatkan audit log dari tabel tertentu
     */
    public function scopeForTable($query, $tableName)
    {
        return $query->where('table_name', $tableName);
    }

    /**
     * Scope untuk mendapatkan audit log action tertentu
     */
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }
}
