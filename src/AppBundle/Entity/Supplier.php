<?php

namespace AppBundle\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

class Supplier implements ResourceInterface
{
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $code;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
