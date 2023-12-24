<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelCuti extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'cuti'; // Define the table name

    protected $fillable = [
        'nip',
        'name',
        'email',
        'bagian',
        'pangkat',
        'jabatan',
        'jenis_cuti',
        'tgl_cuti',
        'hari',
        'alamat_cuti',
        'status',
        'status_admin',
        'approve_by',
        // Add other fields that you want to be fillable here
    ];
}
