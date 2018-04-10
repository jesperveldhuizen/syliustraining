<?php

namespace AppBundle\Entity;

use Sylius\Component\Core\Model\Product as BaseProduct;

class Product extends BaseProduct
{
    /** @var Supplier */
    private $supplier;

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(Supplier $supplier): void
    {
        $this->supplier = $supplier;
    }
}
