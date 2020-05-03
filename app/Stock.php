<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Stock extends Model
{
    protected $table = 'stock';
    protected $guarded = [];

    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function track()
    {
        // hit an api endpoint for an associate retailer
        if ($this->retailer->name == 'Best Buy') {
            $results = Http::get('http://foo.test')->json();
            
            $this->update([
                'in_stock' => $results['available'],
                'price' => $results['price']
            ]);
        }

        // fetch the up-to-date details for the item
        // and then refresh the current stock record
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
