<?php

namespace App\Models;

use App\Models\User;
use App\Models\KategoriNews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    protected $guarded = ['id'];
    protected $table = 'news';

    public function kategorinews(): BelongsTo
    {
        return $this->belongsTo(KategoriNews::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
