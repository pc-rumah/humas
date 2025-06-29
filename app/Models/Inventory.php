<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    protected $guarded = ['id'];
    protected $table = 'inventori';

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
