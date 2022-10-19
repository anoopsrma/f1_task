<?php

namespace Tests\Feature\Currency;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class DigitalCurrencyVolumeTest extends TestCase
{
    /**
     * Setup Test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $faker = \Faker\Factory::create();
        $this->amount = (int) $faker->randomNumber(5, true);
        $this->response = $this->postJson('api/currency/digital/volume/amount', [
            'amount' => $this->amount,
        ]);
    }

    /**
     * A basic functional test example.
     */
    public function testDigitalCurrencyVolumeSuccessJsonMatch()
    {
        $this->response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'data' => [
                        '*' => [
                            'name',
                            'symbol',
                            'base_rate',
                            'volume',
                        ],
                    ],
                ],
            ])
        ;
    }

    public function testDigitalCurrencyVolumeSuccessJsonKeyType()
    {
        $transaction_commision = (2.5 * $this->amount) / 100;
        $net_amount = $this->amount - $transaction_commision;
        $data = $this->response->decodeResponseJson()['data']['data'];
        foreach ($data as $value) {
            static::assertTrue(is_string($value['name']), 'name =>'.$value['name'].' is not a string');
            static::assertTrue(is_string($value['symbol']), 'symbol =>'.$value['symbol'].' is not a string');
            static::assertTrue(is_int($value['base_rate']), 'base_rate =>'.$value['base_rate'].' is not a integer');
            static::assertTrue(is_float($value['volume']), 'volume =>'.$value['volume'].' is not a integer');

            static::assertTrue(
                $value['volume'] == round($net_amount / $value['base_rate'], 2),
                "volume => volume doesn't match"
            );
        }
    }

    public function testDigitalCurrencyVolumeFailureJson()
    {
        $this->response = $this->postJson('api/currency/digital/volume/amount', [
            'amount' => 0,
        ]);

        $this->response
            ->assertStatus(422)
            ->assertJsonStructure([
                'error',
            ])
            ->assertJson(function (AssertableJson $json) {
                $json->whereType('error', 'string');
            })
        ;
    }

public function testDigitalCurrencyVolumeFailureJsonKeyType()
{
    $faker = \Faker\Factory::create();
    $this->response = $this->postJson('api/currency/digital/volume/amount', [
        'amount' => $faker->word(),
    ]);

    $this->response
        ->assertStatus(422)
        ->assertJsonStructure([
            'error',
        ])
        ->assertJson(function (AssertableJson $json) {
            $json->whereType('error', 'string');
        })
    ;
}
}
