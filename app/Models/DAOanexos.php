<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DAOanexos extends Model
{
    use HasFactory;
    protected $table = 'tb_anexos';

    public function anexos(): BelongsTo{

        return $this->belongsTo(DAOaps::class, 'id_aps', 'id');
    }
}
