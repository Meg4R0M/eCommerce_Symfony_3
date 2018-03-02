<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/12/16
 * Time: 22:34
 */

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Commandes;

class CommandesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comande1 = new Commandes();
        $comande1->setUtilisateur($this->getReference('utilisateur1'));
        $comande1->setValider('1');
        $comande1->setDate(new \DateTime());
        $comande1->setReference('1');
        $comande1->setProduits(array('0' => array('1' => '2'),
                                     '1' => array('2' => '1'),
                                     '2' => array('4' => '5')
                               ));
        $manager->persist($comande1);

        $comande2 = new Commandes();
        $comande2->setUtilisateur($this->getReference('utilisateur3'));
        $comande2->setValider('1');
        $comande2->setDate(new \DateTime());
        $comande2->setReference('2');
        $comande2->setProduits(array('0' => array('1' => '2'),
                                     '1' => array('2' => '1'),
                                     '2' => array('4' => '5')
                               ));
        $manager->persist($comande2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}