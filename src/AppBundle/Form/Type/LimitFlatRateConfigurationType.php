<?php

declare(strict_types=1);

namespace AppBundle\Form\Type;

use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

final class LimitFlatRateConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', IntegerType::class, [
                'label' => 'app.form.shipping_calculator.limited_flat_rate_configuration.limit'
            ])
            ->add('amount', MoneyType::class, [
                'label' => 'sylius.form.shipping_calculator.flat_rate_configuration.amount',
                'constraints' => [
                    new NotBlank(['groups' => ['sylius']]),
                    new Type(['type' => 'integer', 'groups' => ['sylius']]),
                ],
                'currency' => 'USD',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'app_shipping_calculator_limited_flat_rate';
    }
}
