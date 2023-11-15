<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingInformation()
    {
        return $this->hasOne(ShippingInformation::class);
    }
    public function billingInformation()
    {
        return $this->hasOne(BillingInformation::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
