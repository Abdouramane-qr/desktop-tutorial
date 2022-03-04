<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'article',
        'quantite',
         'price',
    ];

    private $Prixtotl;
    Private $total;
    public  $ptixtt;
 
public function ptotal()
{

     $this->Prixtotl= $this->price  *  $this->quantite;
    return $this->Prixtotl;
}


        public function ptixtt()
        {
$this->total +=$this->Prixtotl;
return $this->total;
        }
}
