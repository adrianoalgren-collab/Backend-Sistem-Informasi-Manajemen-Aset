<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // Karena nama tabel bukan default plural
    protected $table = 'department';

    // Primary key bukan "id"
    protected $primaryKey = 'id_department';

    // Karena primary key pakai increments (int)
    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'kode_department',
        'nama_department',
        'penanggungjawab_department',
        'email_department',
        'nomor_telepon_department'
    ];

    // Relasi ke User (nanti kalau sudah ditambahkan FK)
    public function users()
    {
        return $this->hasMany(User::class, 'id_department', 'id_department');
    }
}