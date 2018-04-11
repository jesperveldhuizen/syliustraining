<?php

namespace AppBundle\Promotion\Checker;

use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Promotion\Checker\Rule\RuleCheckerInterface;
use Sylius\Component\Promotion\Model\PromotionSubjectInterface;
use Webmozart\Assert\Assert;

final class BirthdayRuleChecker implements RuleCheckerInterface
{
    public const TYPE = 'birthday_today';

    public function isEligible(PromotionSubjectInterface $subject, array $configuration): bool
    {
        if (!$subject instanceof OrderInterface) {
            return false;
        }

        $customer = $subject->getCustomer();

        if (!$customer instanceof CustomerInterface) {
            return false;
        }

        $birthday = $customer->getBirthday();

        if (!$birthday instanceof \DateTimeInterface) {
            return false;
        }

        $today = new \DateTime();

        return ($birthday->format('md') === $today->format('md'));
    }
}
