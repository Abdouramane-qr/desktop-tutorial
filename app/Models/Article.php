<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prixUnitaire',
        'stockMinimal',
        'stockMaximal',
    ];

    public function commandes()
    {
        $this->belongToMany(CommandeArticle::class, 'article_id', 'id');
    }



}
