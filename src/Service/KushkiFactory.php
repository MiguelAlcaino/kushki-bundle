<?php

namespace MiguelAlcaino\KushkiBundle\Service;

use kushki\lib\Kushki;
use kushki\lib\KushkiEnvironment;

class KushkiFactory
{
    public static function create($privateMerchantId, $language, $currency, $isDev = true): Kushki
    {
        $env = $isDev ? KushkiEnvironment::TESTING : KushkiEnvironment::PRODUCTION;

        return new Kushki($privateMerchantId, $language, $currency, $env);
    }
}