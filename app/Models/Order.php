<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $table="orders";
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fillable = Schema::getColumnListing($this->getTable());
    }
    
    public function detailOrders(){
        return $this->hasMany(DetailOrder::class);
    }
}
