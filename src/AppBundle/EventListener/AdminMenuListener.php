<?php

namespace AppBundle\EventListener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    /**
     * @param MenuBuilderEvent $builderEvent
     */
    public function addSupplierMenu(MenuBuilderEvent $builderEvent): void
    {
        $menu = $builderEvent->getMenu();

        $newSubmenu = $menu
            ->addChild('new')
            ->setLabel('Suppliers')
        ;

        $newSubmenu
            ->addChild('supplier', ['route' => 'app_admin_supplier_index'])
            ->setLabel('Manage Suppliers')
            ->setLabelAttribute('icon', 'address card outline')
        ;
    }
}
