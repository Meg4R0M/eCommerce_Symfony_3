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
use Ecommerce\EcommerceBundle\Entity\Media;

class MediaData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $media1 = new Media();
        $media1->setName('Thé de Ceylan');
        $media1->setPath('http://www.dammann.fr/3370-home_default/ceylan-op-finest.jpg');
        $media1->setAlt('Thé de Ceylan');
        $manager->persist($media1);

        $media2 = new Media();
        $media2->setName('Thé des Mile Collines');
        $media2->setPath('http://www.dammann.fr/1100-home_default/the-des-miLe-Collines.jpg');
        $media2->setAlt('Thé des Mile Collines');
        $manager->persist($media2);

        $media3 = new Media();
        $media3->setName('Amore');
        $media3->setPath('http://www.dammann.fr/3283-home_default/amore.jpg');
        $media3->setAlt('Amore');
        $manager->persist($media3);

        $media4 = new Media();
        $media4->setName('Sikkim G.F.O.P');
        $media4->setPath('http://www.dammann.fr/3284-home_default/sikkim-temi-gfop-in-between.jpg');
        $media4->setAlt('Sikkim G.F.O.P');
        $manager->persist($media4);

        $media5 = new Media();
        $media5->setName('Mist Valley');
        $media5->setPath('http://www.dammann.fr/3413-home_default/nepal-tgfop-mist-vaLey.jpg');
        $media5->setAlt('Mist Valley');
        $manager->persist($media5);

        $media6 = new Media();
        $media6->setName('Indian Breakfast');
        $media6->setPath('http://www.dammann.fr/3399-home_default/the-noir-indian-breakfast.jpg');
        $media6->setAlt('Indian Breakfast');
        $manager->persist($media6);

        $media7 = new Media();
        $media7->setName('EARL Grey Pointes Blanches');
        $media7->setPath('http://www.dammann.fr/3285-home_default/the-noir-earl-grey-pointes-blanches.jpg');
        $media7->setAlt('EARL Grey Pointes Blanches');
        $manager->persist($media7);

        $media8 = new Media();
        $media8->setName('Nilgiri Chamraj Golden Tips');
        $media8->setPath('http://www.dammann.fr/3420-home_default/the-d-inde-nilgiri-chamraj-golden-tips.jpg');
        $media8->setAlt('Nilgiri Chamraj Golden Tips');
        $manager->persist($media8);

        $manager->flush();

        $this->addReference('media1', $media1);
        $this->addReference('media2', $media2);
        $this->addReference('media3', $media3);
        $this->addReference('media4', $media4);
        $this->addReference('media5', $media5);
        $this->addReference('media6', $media6);
        $this->addReference('media7', $media7);
        $this->addReference('media8', $media8);
    }

    public function getOrder()
    {
        return 1;
    }
}