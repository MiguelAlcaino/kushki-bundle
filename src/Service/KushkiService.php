<?php

namespace MiguelAlcaino\KushkiBundle\Service;

use kushki\lib\Amount;
use kushki\lib\ExtraTaxes;
use kushki\lib\Kushki;
use kushki\lib\Transaction;

class KushkiService
{
    const KUSHKI_AUTHORIZED = 'authorized';
    const KUSHKI_REFUNDED = 'refunded';

    /**
     * @var Kushki
     */
    private $kushki;

    /**
     * KushkiService constructor.
     *
     * @param Kushki $kushki
     */
    public function __construct(Kushki $kushki)
    {
        $this->kushki = $kushki;
    }

    /**
     * Executes a Kushki charge by a given $creditCardToken and a $amount
     *
     * @param string     $creditCardToken
     * @param string|int $amount
     * @param array      $metadata
     *
     * @return Transaction
     * @throws \kushki\lib\KushkiException
     *
     */
    public function charge(string $creditCardToken, $amount, array $metadata = []): ?Transaction
    {
        $subtotalIva       = $amount;
        $iva               = 0;
        $subtotalIva0      = 0;
        $propina           = 0;
        $tasaAeroportuaria = 0;
        $agenciaDeViaje    = 0;
        $iac               = 0;
        $extraTaxes        = new ExtraTaxes($propina, $tasaAeroportuaria, $agenciaDeViaje, $iac);
        $kushkiAmount      = new Amount($subtotalIva, $iva, $subtotalIva0, $extraTaxes);

        return $this->kushki->charge($creditCardToken, $kushkiAmount, $metadata);
    }

    /**
     * Number of months sent from the browser in the kushkiDeferred parameter, converted to Integer
     *
     * @param string     $creditCardToken
     * @param string|int $amount
     * @param int        $months
     * @param array      $metadata
     *
     * @return Transaction
     * @throws \kushki\lib\KushkiException
     */
    public function deferredCharge(string $creditCardToken, $amount, int $months, array $metadata = []): ?Transaction
    {
        $subtotalIva  = $amount;
        $iva          = 0;
        $subtotalIva0 = 0;
        $ice          = 0;
        $kushkiAmount = new Amount($subtotalIva, $iva, $subtotalIva0, $ice);

        return $this->kushki->deferredCharge($creditCardToken, $kushkiAmount, $months, $metadata);
    }

    /**
     * @param $ticketNumber
     *
     * @return Transaction
     * @throws \kushki\lib\KushkiException
     */
    public function refund($ticketNumber): ?Transaction
    {
        return $this->kushki->voidCharge($ticketNumber);
    }
}