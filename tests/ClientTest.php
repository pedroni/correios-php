<?php

namespace Pedroni\Correios\Tests;

use Pedroni\Correios\Client;
use Pedroni\Correios\Contracts\FreightInterface;
use Pedroni\Correios\Contracts\ZipCodeInterface;

class ClientTest extends TestCase
{
    /**
     * @var \Pedroni\Correios\Tests\Client
     */
    protected $correios;

    protected function setUp(): void
    {
        parent::setUp();

        $this->correios = new Client();
    }

    public function testFreightService()
    {
        $this->assertInstanceOf(FreightInterface::class, $this->correios->freight());
    }

    public function testZipCodeService()
    {
        $this->assertInstanceOf(ZipCodeInterface::class, $this->correios->zipcode());
    }
}
