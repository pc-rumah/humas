<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agenda extends Model
{
    protected $guarded = ['id'];
    protected $table = 'agenda';

    public function kategorinews(): BelongsTo
    {
        return $this->belongsTo(KategoriNews::class, 'kategori_id');
    }
}
