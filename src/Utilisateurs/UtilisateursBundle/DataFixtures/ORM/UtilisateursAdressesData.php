<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/12/16
 * Time: 22:34
 */

namespace Utilisateurs\UtilisateursBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\UtilisateursAdresses;

class UtilisateursAdressesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $adresse1 = new UtilisateursAdresses();
        $adresse1->setUtilisateur($this->getReference('utilisateur1'));
        $adresse1->setNom('Durano');
        $adresse1->setPrenom('Florian');
        $adresse1->setTelephone('0632845192');
        $adresse1->setAdresse('1 rue du Doyenné');
        $adresse1->setCp('30100');
        $adresse1->setPays('France');
        $adresse1->setVille('Alès');
        $adresse1->setComplement('à coté de la cathédrale');
        $manager->persist($adresse1);

        $adresse2 = new UtilisateursAdresses();
        $adresse2->setUtilisateur($this->getReference('utilisateur3'));
        $adresse2->setNom('Briat');
        $adresse2->setPrenom('Marie-Christine');
        $adresse2->setTelephone('0632845129');
        $adresse2->setAdresse('5 Lot "La Charmeraie');
        $adresse2->setCp('30510');
        $adresse2->setPays('France');
        $adresse2->setVille('Générac');
        $adresse2->setComplement('Route de Nîmes');
        $manager->persist($adresse2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}