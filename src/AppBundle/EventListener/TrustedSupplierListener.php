<?php

namespace AppBundle\EventListener;


use AppBundle\Entity\Supplier;
use Sylius\Component\Mailer\Sender\SenderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class TrustedSupplierListener
{
    /**
     * @var SenderInterface
     */
    private $sender;

    public function __construct(SenderInterface $sender)
    {
        $this->sender = $sender;
    }

    public function sendTrustedEmail(GenericEvent $event): void
    {
        /** @var Supplier $supplier */
        $supplier = $event->getSubject();
        Assert::isInstanceOf($supplier, Supplier::class);

        $this->sender->send('trusted_email', [$supplier->getEmail()]);
    }
}
