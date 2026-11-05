<?php

namespace App\Modules\Catalog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Internal to Catalog: other modules go through ProductCatalog.
 */
class Product extends Model
{
    protected $fillable = ['sku', 'name', 'price', 'stock'];
}
