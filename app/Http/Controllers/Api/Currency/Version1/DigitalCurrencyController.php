<?php

namespace App\Http\Controllers\Api\Currency\Version1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DigitalCurrencyRequest;
use App\Services\Currency\DigitalCurrencyService;

class DigitalCurrencyController extends Controller
{
    /**
     * Dependency Injection.
     */
    public function __construct(
        protected DigitalCurrencyService $digitalCurrencyService
    ) {
    }

    /**
     * Retrieve Volume of Digital Currencies By Amount.
     */
    public function volumeOfCurrenciesByAmount(DigitalCurrencyRequest $request): object
    {
        if (!$currencies = $this->digitalCurrencyService->volumeOfCurrenciesByAmount($request->amount)) {
            return response()->json([
                'error' => $this->digitalCurrencyService->getErrorMessage(),
            ], $this->digitalCurrencyService->getErrorStatus());
        }

        return response()->json([
            'data' => $currencies
        ], 200);
    }
}
