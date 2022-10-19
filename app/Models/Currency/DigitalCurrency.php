<?php

namespace App\Models\Currency;

use Illuminate\Database\Eloquent\Model;

class DigitalCurrency extends Model
{
    /**
     * Table Name.
     */
    protected $table = 'digital_currencies';

    /**
     * Guarded Attributes.
     */
    protected $guarded = [];
}
