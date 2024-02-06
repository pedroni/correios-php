<?php

namespace Pedroni\Correios\Tests\Services;

use Pedroni\Correios\Tests\TestCase;
use GuzzleHttp\Client as HttpClient;
use Pedroni\Correios\Services\ZipCode;

class ZipCodeTest extends TestCase
{
    /**
     * HTTP Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $http;

    protected function setUp(): void
    {
        parent::setUp();

        $this->http = new HttpClient;
    }

    public function testNotFoundZipCode()
    {
        $zipcode = new ZipCode($this->http);

        $this->assertEquals([
            'error' => 'CEP não encontrado',
        ], $zipcode->find('99999-999'));
    }

    public function testFindAddressByZipCode()
    {
        $zipcode = new ZipCode($this->http);

        $this->assertEquals([
            'zipcode' => '01001-000',
            'street' => 'Praça da Sé',
            'complement' => ['- lado ímpar'],
            'district' => 'Sé',
            'city' => 'São Paulo',
            'uf' => 'SP',
        ], $zipcode->find('01001-000'));
    }
}
