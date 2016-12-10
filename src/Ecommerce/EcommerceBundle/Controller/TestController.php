<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 07/12/16
 * Time: 09:48
 */

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\EcommerceBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ecommerce\EcommerceBundle\Entity\Produits;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ecommerce\EcommerceBundle\Form\testType;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{

    public function testFormulaireAction(Request $request)
    {
        $form = $this->createForm(testType::class);

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            var_dump($form->getData());

            die('Resultat du formulaire');
        }

        return $this->render('EcommerceBundle:Default:test.html.twig', array('form' => $form->createView()));
    }

    /*public function ajoutAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produit = new Produits();
        $produit->setCategorie('Thés');
        $produit->setDescription('Du bon thé bien bio de chez nous');
        $produit->setDisponible('1');
        $produit->setImage('http://www.comptoirsrichard.fr/media/catalog/product/cache/1/image/cbcbef48e5e3bcce7c7ed908f20bc5b4/9/9/9990000024438-the-noir-noel-comptoirs.jpg');
        $produit->setNom('Thé de noel');
        $produit->setPrix('4.59');
        $produit->setTva('19.6');

        $em->persist($produit);

        $produit2 = new Produits();
        $produit2->setCategorie('Thés');
        $produit2->setDescription('Du bon thé bien bio de chez eux');
        $produit2->setDisponible('1');
        $produit2->setImage('http://www.arbadea.com/uploads/satellite/happy-rooibos/happy-rooibos-vrac.jpg');
        $produit2->setNom('Thé happy-rooibos');
        $produit2->setPrix('5.95');
        $produit2->setTva('19.6');

        $em->persist($produit2);
        $em->flush();
        $produits = $em->getRepository('EcommerceBundle:Produits')->findAll();

        return $this->render('EcommerceBundle:Default:test.html.twig', array('produits' => $produits));
    }*/
}