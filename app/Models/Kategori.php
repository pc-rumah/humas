<?php

namespace App\Models;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kategori extends Model
{
    protected $guarded = ['id'];
    protected $table = 'kategori';

    public function inventori(): BelongsToMany
    {
        return $this->belongsToMany(Inventory::class);
    }
}
