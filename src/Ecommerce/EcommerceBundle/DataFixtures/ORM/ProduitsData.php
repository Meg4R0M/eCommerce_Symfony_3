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
use Ecommerce\EcommerceBundle\Entity\Produits;

class ProduitsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $produits1 = new Produits();
        $produits1->setCategorie($this->getReference('categorie1'));
        $produits1->setDescription('Une feuille entière donnant une infusion légère, parfait pour le thé de cinq heures. ');
        $produits1->setDisponible('1');
        $produits1->setImage($this->getReference('media1'));
        $produits1->setNom('Thé de Ceylan - Ceylan O.P. Finest');
        $produits1->setPrix('5.50');
        $produits1->setTva($this->getReference('tva2'));
        $manager->persist($produits1);

        $produits2 = new Produits();
        $produits2->setCategorie($this->getReference('categorie1'));
        $produits2->setDescription('Si les paysages rwandais, verts et ondoyants, inspirent la douceur, le thé l à-bas se boit corsé. Il allie la force d\'un thé noir du Rwanda et le parfum de fines épices: gingembre, cannelle, cardamome, baies roses et girofle. Il pourra être consommé nature, avec un nuage de lait ou encore infusé directement dans du lait.');
        $produits2->setDisponible('1');
        $produits2->setImage($this->getReference('media2'));
        $produits2->setNom('Thé Noir - Thé des Mille Collines');
        $produits2->setPrix('7.50');
        $produits2->setTva($this->getReference('tva2'));
        $manager->persist($produits2);

        $produits3 = new Produits();
        $produits3->setCategorie($this->getReference('categorie1'));
        $produits3->setDescription('Attendu comme un baiser, doux comme une promesse "Amore" à sa façon, célèbre l\'amour avec délicatesse. Un thé noir, des pétales de fleurs, des notes poudrées d\'amande grillée, d\'héliotrope et de chocolat, des huiles essentielles de bergamote, de rose et de poivre, invitent les amoureux dans le partage d\'une ronde suave et parfumée.');
        $produits3->setDisponible('1');
        $produits3->setImage($this->getReference('media3'));
        $produits3->setNom('Thé Noir - Amore');
        $produits3->setPrix('7.00');
        $produits3->setTva($this->getReference('tva2'));
        $manager->persist($produits3);

        $produits4 = new Produits();
        $produits4->setCategorie($this->getReference('categorie1'));
        $produits4->setDescription('Petit Royaume situé dans l’Himalaya produisant un seul «Grand Jardin» : TEMI. Une récolte de printemps remarquable, thé « between » oscillant entre la primeur des First Flush et la longueur en bouche des Second Flush, selon le temps d’infusion choisit. Nature l’après midi ou le soir.');
        $produits4->setDisponible('1');
        $produits4->setImage($this->getReference('media4'));
        $produits4->setNom('Thé du Sikkim - Sikkim G.F.O.P. Temi In Between');
        $produits4->setPrix('8.00');
        $produits4->setTva($this->getReference('tva2'));
        $manager->persist($produits4);

        $produits5 = new Produits();
        $produits5->setCategorie($this->getReference('categorie2'));
        $produits5->setDescription('Superbe lot pour cette plantation située sur les contreforts de l’Himalaya. feuilles superbes et régulières possédant de nombreuses pointes argentées et dorées !Tasse à la liqueur douce, mûre, possédant des notes similaires aux Darjeeling. Un pur moment de bonheur et d’évasion. ');
        $produits5->setDisponible('1');
        $produits5->setImage($this->getReference('media5'));
        $produits5->setNom('Thé du Népal - Mist Valley T.G.F.O.P.');
        $produits5->setPrix('15.00');
        $produits5->setTva($this->getReference('tva1'));
        $manager->persist($produits5);

        $produits6 = new Produits();
        $produits6->setCategorie($this->getReference('categorie2'));
        $produits6->setDescription('Mélange de thé en provenance de plantations biologiques de Darjeeling et d’Assam. Arôme robuste, malté et corsé de l’Assam, aLié à l’arôme plus suave et floral du Darjeeling. Un délicieux mélange corsé. Peut convenir l’après midi avec une infusion réduite ou bien le matin avec du lait.');
        $produits6->setDisponible('1');
        $produits6->setImage($this->getReference('media6'));
        $produits6->setNom('Thé noir - Indian Breakfast');
        $produits6->setPrix('7.00');
        $produits6->setTva($this->getReference('tva1'));
        $manager->persist($produits6);

        $manager->flush();

    }

    public function getOrder()
    {
        return 4;
    }
}