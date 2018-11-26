<?php

namespace MiguelAlcaino\KushkiBundle\Model;

use MiguelAlcaino\PaymentGateway\Interfaces\Entity\TransactionRecordInterface;

interface KushkiProcessPaymentHandlerInterface
{
    /**
     * Receives a TransactionRecordInterface instance, process it and persists it in the database
     *
     * @param TransactionRecordInterface $transactionRecord
     *
     * @return TransactionRecordInterface
     */
    public function saveTransactionRecord(TransactionRecordInterface $transactionRecord);
}