<?php

namespace MiguelAlcaino\KushkiBundle\Tests;

use kushki\lib\Kushki;
use kushki\lib\Transaction;
use MiguelAlcaino\KushkiBundle\Service\KushkiService;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class KushkiServiceTest extends TestCase
{

    public function testChargeSuccess()
    {
        $kuskiService = new KushkiService(
            $this->mockKushki(
                'VALID-TICKET',
                true
            )
        );
        $transaction  = $kuskiService->charge(
            'VALID-CREDIT-CARD-TOKEN',
            1000,
            []
        );

        $this->assertEquals(true, $transaction->isSuccessful());
    }

    private function mockKushki($ticketNumber, $isSuccessful)
    {
        $kushkiMock = $this->prophesize(Kushki::class);
        $kushkiMock->charge(Argument::any(), Argument::any(), Argument::any())->willReturn(
            $this->mockKuskiTransaction(
                $ticketNumber,
                $isSuccessful
            )
        );

        return $kushkiMock->reveal();
    }

    private function mockKuskiTransaction($ticketNumber, $isSuccessful)
    {
        $kushkiTransactionMock = $this->prophesize(Transaction::class);
        $kushkiTransactionMock->getTicketNumber()->willReturn($ticketNumber);
        $kushkiTransactionMock->isSuccessful()->willReturn($isSuccessful);

        return $kushkiTransactionMock->reveal();
    }
}
