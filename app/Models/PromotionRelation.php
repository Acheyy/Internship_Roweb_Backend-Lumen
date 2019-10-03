<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Promotion
 * @package App\Models
 */
class PromotionRelation extends Model
{
    protected $table = 'promotion_relations';

    public $timestamps = true;

    public $fillable = [
        'promotion_id',
        'category_id',
        'subcategory_id',
    ];

   
    public function promotion()
    {
        return $this->belongsTo('App\Models\Promotion', 'promotion_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'subcategory_id', 'id');
    }

  
}
