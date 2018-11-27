<?php

namespace MiguelAlcaino\KushkiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class SubmittedCreditCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastFourDigits', HiddenType::class, [
                'required' => true
            ])
            ->add('cardHolderName', HiddenType::class, [
                'required' => true
            ])
            ->add('creditCardType', HiddenType::class, [
                'required' => false
            ]);
    }

    public function getBlockPrefix()
    {
        return 'kushki_submitted_credit_card';
    }

}