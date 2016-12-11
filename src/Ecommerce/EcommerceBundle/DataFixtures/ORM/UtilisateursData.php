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
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Utilisateurs\UtilisateursBundle\Entity\Utilisateurs;

class UtilisateursData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $utilisateur1 = new Utilisateurs();
        $utilisateur1->setUsername('Meg4R0M');
        $utilisateur1->setEmail('psykoterro@gmail.com');
        $utilisateur1->setEnabled(1);
        $utilisateur1->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur1)->encodePassword('panas0n1c1', $utilisateur1->getSalt()));
        $manager->persist($utilisateur1);

        $utilisateur2 = new Utilisateurs();
        $utilisateur2->setUsername('Meg4R0M30');
        $utilisateur2->setEmail('meg4r0m30@gmail.com');
        $utilisateur2->setEnabled(1);
        $utilisateur2->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur2)->encodePassword('panas0n1c2', $utilisateur2->getSalt()));
        $manager->persist($utilisateur2);

        $utilisateur3 = new Utilisateurs();
        $utilisateur3->setUsername('Meg4R0M34');
        $utilisateur3->setEmail('meg4r0m34@gmail.com');
        $utilisateur3->setEnabled(1);
        $utilisateur3->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur3)->encodePassword('panas0n1c3', $utilisateur3->getSalt()));
        $manager->persist($utilisateur3);

        $utilisateur4 = new Utilisateurs();
        $utilisateur4->setUsername('Meg4R0M81');
        $utilisateur4->setEmail('meg4r0m81@gmail.com');
        $utilisateur4->setEnabled(1);
        $utilisateur4->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur4)->encodePassword('panas0n1c4', $utilisateur4->getSalt()));
        $manager->persist($utilisateur4);

        $utilisateur5 = new Utilisateurs();
        $utilisateur5->setUsername('Meg4R0M13');
        $utilisateur5->setEmail('meg4r0m13@gmail.com');
        $utilisateur5->setEnabled(1);
        $utilisateur5->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur5)->encodePassword('panas0n1c5', $utilisateur5->getSalt()));
        $manager->persist($utilisateur5);

        $manager->flush();

        $this->addReference('utilisateur1', $utilisateur1);
        $this->addReference('utilisateur2', $utilisateur2);
        $this->addReference('utilisateur3', $utilisateur3);
        $this->addReference('utilisateur4', $utilisateur4);
        $this->addReference('utilisateur5', $utilisateur5);
    }

    public function getOrder()
    {
        return 5;
    }
}