<?php

namespace App\Services\Currency;

use App\Models\Currency\DigitalCurrency;
use App\Services\ApiService;
use Exception;

class DigitalCurrencyService extends ApiService
{
    /**
     * Dependency injection.
     */
    public function __construct(protected DigitalCurrency $digitalCurrency)
    {
    }

    public function volumeOfCurrenciesByAmount(int $amount): object|bool
    {
        try {
            $transaction_commision = (2.5 * $amount) / 100;
            $net_amount = $amount - $transaction_commision;
            $currencies = $this->digitalCurrency->select([
                'name',
                'symbol',
                'base_rate'
            ])->paginate(100);
            foreach ($currencies->items() as $currency) {
                $currency->volume = round($net_amount / $currency->base_rate, 2);
            }

            return $currencies;
        } catch (Exception $e) {
            return $this->setError($e->getMessage(), 422);
        }
    }
}
