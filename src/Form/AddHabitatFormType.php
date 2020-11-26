<?php

namespace App\Form;

use App\Entity\Habitat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddHabitatFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('streetAddress', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an address',
                    ]),
                ],
            ])
            ->add('postalCode', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a postal code',
                    ]),
                ],
            ])
            ->add('displayName', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a display name for your habitat',
                    ]),
                ],
                'help' => 'Le nom qui sera affiché pour l\'habitat'
            ])
            ->add('macAddress', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a MAC address',
                    ]),
                ],
                'help' => 'L\'addresse MAC du router de votre habitat'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Habitat::class,
        ]);
    }
}
