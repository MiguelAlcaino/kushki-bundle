<?php

namespace MiguelAlcaino\KushkiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Luhn;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreditCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $years = range(date('y'), date('y') + 10);

        $builder
            ->add('cardHolderName', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'creditcard.card_holder.not_blank'
                    ]),
                    new Length([
                        'minMessage' => 'creditcard.card_holder.length_min',
                        'min' => 2
                    ])
                ]
            ])
            ->add('cardNumber', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Luhn([
                        'message' => 'El número de tarjeta es inválido.'
                    ]),
                    new Length([
                        'min' => 13,
                        'max' => 19,
                        'minMessage' => 'El número de la tarjeta debe contener al menos 13 digitos',
                        'maxMessage' => 'El número de la tarjeta debe contener al máximo 19 digitos'
                    ])
                ],
                'attr' => [
                    'onkeydown' => 'return ( event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )',
                    'autocomplete' => 'off',
                    'minlength' => 13,
                    'maxlength' => 19
                ]
            ])
            ->add('month', ChoiceType::class, [
                'empty_data' => null,
                'placeholder' => 'Mes',
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'invalid_message' => 'El valor del mes de expiración no es válido.',
                'choices' => [
                    '01' => '01',
                    '02' => '02',
                    '03' => '03',
                    '04' => '04',
                    '05' => '05',
                    '06' => '06',
                    '07' => '07',
                    '08' => '08',
                    '09' => '09',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor seleccione un mes de expiración.'
                    ])
                ]
            ])
            ->add('year', ChoiceType::class, [
                'empty_data' => null,
                'placeholder' => 'Año',
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'invalid_message' => 'El valor del año de expiración no es válido.',
                'choices' => array_combine($years, $years),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor seleccione un año de expiración.'
                    ])
                ]
            ])
            ->add('cvc', PasswordType::class, [
                'required' => true,
                'attr' => [
                    'onkeydown' => 'return ( event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )',
                    'autocomplete' => 'off',
                    'maxlength' => 4,
                    'minlength' => 3
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, completa el CVC.'
                    ]),
                    new Length([
                        'min' => 3,
                        'max' => 4,
                        'minMessage' => 'El código de seguirdad debe contener al menos 3 digitos.',
                        'maxMessage' => 'El código de seguirdad debe contener al máximo 4 digitos.'
                    ])
                ]
            ]);
    }

    public function getBlockPrefix()
    {
        return 'kushki_credit_card';
    }

}