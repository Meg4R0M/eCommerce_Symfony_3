<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitsController extends Controller
{
    public function produitsAction($categorie = null, Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        if ($categorie != null) {
            $exist = $em->getRepository('EcommerceBundle:Categories')->find($categorie);
        }

        if ($categorie != null && $exist != "" ) {
            $produits = $em->getRepository('EcommerceBundle:Produits')->byCategorie($categorie);
        } elseif ($categorie == null) {
            $produits = $em->getRepository('EcommerceBundle:Produits')->findBy(array('disponible' => 1));
        } else {
            throw $this->createNotFoundException('La page n\'existe pas.');
        }

        if ($session->has('panier')) {
            $panier = $session->get('panier');
        } else {
            $panier = false;
        }

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits,
                                                                                                 'panier' => $panier));
    }
    
    public function presentationAction($id, Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('EcommerceBundle:Produits')->find($id);

        if (!$produit) throw $this->createNotFoundException('La page n\'existe pas.');

        if ($session->has('panier'))
        {
            $panier = $session->get('panier');
        }else{
            $panier = false;
        }

        return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig', array('produit' => $produit,
                                                                                                     'panier' => $panier));
    }

    public function rechercheAction()
    {
        $form = $this->createForm(RechercheType::class);
        return $this->render('EcommerceBundle:Default:Recherche/modulesUsed/recherche.html.twig', array('form' => $form->createView()));
    }

    public function rechercheTraitementAction()
    {
        $request = Request::createFromGlobals();
        $form = $this->createForm(RechercheType::class);
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository('EcommerceBundle:Produits')->recherche($form['recherche']->getData());
        } else {
            throw $this->createNotFoundException('La page n\'existe pas.');
        }

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits));
    }
}