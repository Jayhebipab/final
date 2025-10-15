<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'inventories';

    // Primary key
    protected $primaryKey = 'id';

    // Allow mass assignment for these fields
    protected $fillable = [
        'product_id',
        'product_name',
        'category',
        'quantity',
        'cost_price',
        'selling_price',
        'photo',
        'title',
        'description',
        ];

    /**
     * ✅ Relationship: Each inventory belongs to a supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    /**
     * ✅ Relationship: Each inventory is linked to a product
     *  (so you can fetch product details directly)
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * ✅ Helper function: Get product details by ID (for AJAX)
     */
    public static function getProductDetails($productId)
    {
        return \DB::table('products')
            ->select('id', 'name', 'category')
            ->where('id', $productId)
            ->first();
    }
}
