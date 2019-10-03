<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Promotion
 * @package App\Models
 */
class Promotion extends Model
{
    protected $table = 'promotions';

    public $timestamps = true;

    public $fillable = [
        'name',
        'percent'
    ];

   
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'userd_id', 'id');
    }
  
    public function promotionRelations()
    {
        return $this->hasMany('App\Models\PromotionRelation', 'promotion_id', 'id');
    }

}
