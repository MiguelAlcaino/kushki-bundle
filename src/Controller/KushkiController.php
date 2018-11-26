<?php

namespace MiguelAlcaino\KushkiBundle\Controller;

use MiguelAlcaino\KushkiBundle\Form\TokenType;

use MiguelAlcaino\KushkiBundle\Service\KushkiService;
use MiguelAlcaino\MindbodyPaymentsBundle\Model\MindbodySession;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("kushki")
 */
class KushkiController extends AbstractController
{
    /**
     * @param Request       $request
     * @param KushkiService $kushkiService
     *
     * @return Response
     * @Route("/process-payment",name="kushki_process_payment")
     */
    public function processPaymentAction(
        Request $request,
        KushkiService $kushkiService
    ) {
        $form = $this->createForm(TokenType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $token  = $form->get('token')->getData();
            $amount = $request->getSession()->get(MindbodySession::MINDBODY_GRAND_TOTAL_VAR_NAME);

            $kushkiService->charge($token, $amount);
        }

        return new Response('<html><body>hola</body></html>');
    }
}