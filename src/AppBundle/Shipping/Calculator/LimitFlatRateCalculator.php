<?php

declare(strict_types=1);

namespace AppBundle\Shipping\Calculator;

use Sylius\Component\Core\Exception\MissingChannelConfigurationException;
use Sylius\Component\Shipping\Calculator\CalculatorInterface;
use Sylius\Component\Shipping\Model\ShipmentInterface;
use Webmozart\Assert\Assert;

final class LimitFlatRateCalculator implements CalculatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function calculate(ShipmentInterface $subject, array $configuration): int
    {
        Assert::isInstanceOf($subject, ShipmentInterface::class);

        $channelCode = $subject->getOrder()->getChannel()->getCode();

        if (!isset($configuration[$channelCode])) {
            throw new MissingChannelConfigurationException(sprintf(
                'Channel %s has no amount defined for shipping method %s',
                $subject->getOrder()->getChannel()->getName(),
                $subject->getMethod()->getName()
            ));
        }

        return (int) ($configuration[$channelCode]['amount'] * ceil($subject->getShippingUnitCount() / $configuration[$channelCode]['limit']));
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'limited_flat_rate';
    }
}
