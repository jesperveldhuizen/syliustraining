<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Supplier;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Component\Core\Formatter\StringInflector;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SM\Factory\FactoryInterface as StateMachineFactoryInterface;

final class SupplierExampleFactory extends AbstractExampleFactory
{
    /** @var OptionsResolver */
    private $resolver;

    /** @var FactoryInterface */
    private $factory;

    /** @var \Faker\Generator */
    private $faker;

    /**
     * @var StateMachineFactoryInterface
     */
    private $stateMachineFactory;

    public function __construct(
        FactoryInterface $factory,
        StateMachineFactoryInterface $stateMachineFactory
    ) {
        $this->resolver = new OptionsResolver();
        $this->factory = $factory;
        $this->faker = \Faker\Factory::create();
        $this->stateMachineFactory = $stateMachineFactory;

        $this->configureOptions($this->resolver);
    }

    public function create(array $options = []): Supplier
    {
        $option = $this->resolver->resolve($options);

        /** @var Supplier $supplier */
        $supplier = $this->factory->createNew();

        $supplier->setName($option['name']);
        $supplier->setCode($option['code']);
        $supplier->setEmail($this->faker->email);

        if ($this->faker->boolean(20)){
            $this->stateMachineFactory->get($supplier, 'app_supplier')->apply('trust');
        }

        return $supplier;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('name', function (Options $option) {
                return $this->faker->words(3, true);
            })
            ->setDefault('code', function (Options $option) {
                return StringInflector::nameToCode($option['name']);
            })
        ;
    }
}
