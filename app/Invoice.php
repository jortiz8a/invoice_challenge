<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
use PHP_Token_ELSEIF;

class Invoice extends Model
{
    protected $fillable = ['description', 'code', 'client_id', 'store_id', 'expires_at'];


    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'unit_value', 'total_value']);
    }
    public function getSubtotalAttribute()
    {
        if (isset($this->products[0])) {
            return $this->products[0]->pivot->where('invoice_id', $this->id)->sum('total_value');
        } else {
            return 0;
        };
    }

    public function getVatAttribute()
    {
        $subtotal = $this->subtotal;
        return $subtotal * (.19);
    }

    public function getTotalAttribute()
    {
        $subtotal = $this->subtotal;
        $vat = $this->vat;
        return $subtotal + $vat;
    }

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }
    public function Store()
    {
        return $this->belongsTo(Store::class);
    }

    //Query Scope
    public function scopeClient($query, $client)
    {
        if ($client)
            return Invoice::whereHas(
                'Client',
                function ($query) use ($client) {
                    $query->where('name', 'LIKE', "%$client%");
                }
            );
    }
    public function scopeStore($query, $store)
    {
        if ($store)
            return Invoice::whereHas(
                'Store',
                function ($query) use ($store) {
                    $query->where('name', 'LIKE', "%$store%");
                }
            );
    }
    public function scopeSearch($query, $search, $type)
    {
        if ($type)
            if ($search)
                if ($type == 'client')
                    return Invoice::scopeClient($query, $search);
                elseif ($type == 'Store')
                    return Invoice::scopeStore($query, $search);
                else
                    return $query->where("$type", 'LIKE', "%$search%");
    }

}
