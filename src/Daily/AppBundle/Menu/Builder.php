<?php

/* 
 * @author Krzysiek S
 */

namespace Daily\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
       
        $menu->addChild('Strona główna', array
           ('route' => 'daily_homepage')
               );
        $menu->addChild('Kategorie', array
           ('route' => 'daily_homepage' )
               );
        $menu->addChild('Regulamin', array
           ('route' => 'daily_homepage' )
               );
   
    return $menu;
    }
}