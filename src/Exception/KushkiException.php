<?php

namespace MiguelAlcaino\KushkiBundle\Exception;

use kushki\lib\Transaction;

class KushkiException extends \Exception
{
    /**
     * @var Transaction
     */
    private $transaction;

    /**
     * NotSuccessfulPaymentException constructor.
     *
     * @param Transaction $transaction
     * @param string      $message
     * @param int         $code
     */
    public function __construct(Transaction $transaction, string $message = null, $code = null)
    {
        $this->transaction = $transaction;
        parent::__construct($message, $code);
    }

    /**
     * @return Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}