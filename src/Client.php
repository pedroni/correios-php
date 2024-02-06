<?php

namespace Pedroni\Correios;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HttpClient;
use Pedroni\Correios\Services\Freight;
use Pedroni\Correios\Services\ZipCode;
use Pedroni\Correios\Contracts\FreightInterface;
use Pedroni\Correios\Contracts\ZipCodeInterface;

class Client
{
    public $http;
    /**
     * Serviço de frete.
     *
     * @var \Pedroni\Correios\Contracts\FreightInterface
     */
    protected $freight;

    /**
     * Serviço de CEP.
     *
     * @var \Pedroni\Correios\Contracts\ZipCodeInterface
     */
    protected $zipcode;

    /**
     * Cria uma nova instância da classe Client.
     *
     * @param \GuzzleHttp\ClientInterface|null  $http
     * @param \Pedroni\Correios\Contracts\FreightInterface|null $freight
     * @param \Pedroni\Correios\Contracts\ZipCodeInterface|null $zipcode
     */
    public function __construct(
        ClientInterface $http = null,
        FreightInterface $freight = null,
        ZipCodeInterface $zipcode = null
    ) {
        $this->http = $http ?: new HttpClient;
        $this->freight = $freight ?: new Freight($this->http);
        $this->zipcode = $zipcode ?: new ZipCode($this->http);
    }

    /**
     * Serviço de frete dos Correios.
     *
     * @return \Pedroni\Correios\Contracts\FreightInterface
     */
    public function freight()
    {
        return $this->freight;
    }

    /**
     * Serviço de CEP dos Correios.
     *
     * @return \Pedroni\Correios\Contracts\ZipCodeInterface
     */
    public function zipcode()
    {
        return $this->zipcode;
    }
}
