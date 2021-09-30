<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;
    protected $fillable = ['season', 'number', 'watched', 'serie_id'];
    protected $appends = ['links'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    // Accessors
    public function getWatchedAttribute($watched): bool
    {
        return $watched;
    }

    // Acessor
    public function getLinksAttribute(): array
    {
        return [
            'self' => '/api/episodes/' . $this->id,
            'serie' => '/api/series/' . $this->serie_id
        ];
    }
}

?>