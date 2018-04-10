<?php

declare(strict_types=1);

namespace AppBundle\Shipping\Calculator;

use Sylius\Component\Shipping\Model\ShipmentInterface;

final class LimitFlatRateCalculator implements CalculatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function calculate(ShipmentInterface $subject, array $configuration): int
    {
        Assert::isInstanceOf($subject, ShipmentInterface::class);

        return (int) $configuration['amount'] * ceil($subject->getShippingUnitCount() / $configuration['limit']);
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'limited_flat_rate';
    }
}
