# Correios PHP SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![CircleCI][icon-circleci]][link-circleci]
[![Codecov][icon-codecov]][link-codecov]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

Uma maneira fácil de interagir com as principais funcionalidades dos [Correios](https://correios.com.br).

## Funcionalidades

- [Consultar CEP](#consultar-cep)
- [Calcular Preços e Prazos](#calcular-preços-e-prazos)

## Instalação

Via Composer

``` bash
$ composer require pedroni/correios-php
```

## Uso

### Consultar CEP

Encontrar endereço pelo CEP consultando diretamente o [WebService][correios-sigep] dos Correios.

``` php
use Pedroni\Correios\Client;

require 'vendor/autoload.php';

$correios = new Client;

$correios->zipcode()
    ->find('01001-000');

/*

Resultado:

[
    'zipcode' => '01001-000',
    'street' => 'Praça da Sé',
    'complement' => [
        'lado ímpar',
    ],
    'district' => 'Sé',
    'city' => 'São Paulo',
    'uf' => 'SP',
]
*/
```

### Calcular Preços e Prazos

Calcular preços e prazos de serviços de entrega (Sedex, PAC e etc), com **suporte a multiplos objetos** na mesma consulta.

``` php
use Pedroni\Correios\Client;
use Pedroni\Correios\Service;

require 'vendor/autoload.php';

$correios = new Client;

$correios->freight()
    ->origin('01001-000')
    ->destination('87047-230')
    ->services(Service::SEDEX, Service::PAC)
    ->item(16, 16, 16, .3, 1) // largura, altura, comprimento, peso e quantidade
    ->item(16, 16, 16, .3, 3) // largura, altura, comprimento, peso e quantidade
    ->item(16, 16, 16, .3, 2) // largura, altura, comprimento, peso e quantidade
    ->calculate();

/*

Resultados:

[
    [
        'name' => 'Sedex',
        'code' => 40010,
        'price' => 51,
        'deadline' => 4,
        'error' => [],
    ],
    [
        'name' => 'PAC',
        'code' => 41106,
        'price' => 22.5,
        'deadline' => 9,
        'error' => [],
    ],
]
*/
```

## Change log

Consulte [CHANGELOG](.github/CHANGELOG.md) para obter mais informações sobre o que mudou recentemente.

## Testando

``` bash
$ composer test
```

## Contribuindo

Consulte [CONTRIBUTING](.github/CONTRIBUTING.md) para obter mais detalhes.

## Segurança

Se você descobrir quaisquer problemas relacionados à segurança, envie um e-mail para lucas.pires.mattos@gmail.com em vez de usar as issues.

## Créditos

- [Lucas Pires][link-author]
- [Todos os contribuidores][link-contributors]

## Licença

A Licença MIT (MIT). Consulte o [arquivo de licença](LICENSE.md) para obter mais informações.

[ico-version]: https://img.shields.io/packagist/v/pedroni/correios-php.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pedroni/correios-php.svg?style=flat-square
[icon-circleci]: https://img.shields.io/circleci/project/github/pedroni/correios-php.svg?style=flat-square
[icon-codecov]: https://img.shields.io/codecov/c/github/pedroni/correios-php.svg?style=flat-square

[link-circleci]: https://circleci.com/gh/pedroni/correios-php
[link-codecov]: https://codecov.io/gh/pedroni/correios-php
[link-packagist]: https://packagist.org/packages/pedroni/correios-php
[link-downloads]: https://packagist.org/packages/pedroni/correios-php
[link-author]: https://github.com/flyingluscas
[link-contributors]: ../../contributors

[correios-sigep]: https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl
