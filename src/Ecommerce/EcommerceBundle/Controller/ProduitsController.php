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
            $findProduits = $em->getRepository('EcommerceBundle:Produits')->byCategorie($categorie);
        } elseif ($categorie == null) {
            $findProduits = $em->getRepository('EcommerceBundle:Produits')->findBy(array('disponible' => 1));
        } else {
            throw $this->createNotFoundException('La page n\'existe pas.');
        }

        if ($session->has('panier')) {
            $panier = $session->get('panier');
        } else {
            $panier = false;
        }

        $produits  = $this->get('knp_paginator')->paginate($findProduits,$request->query->get('page', 1),8);

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits,
                                                                                                 'panier' => $panier));
    }

    public function categoriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('EcommerceBundle:Categories')->findAll();

        if (!$categories) throw $this->createNotFoundException('La page n\'existe pas.');

        return $this->render('EcommerceBundle:Default:produits/layout/categories.html.twig', array('categories' => $categories));
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
        $searchTerm = $request->query->get('recherche');

        if ($searchTerm != '') {
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $findProduits = $em->getRepository('EcommerceBundle:Produits')->recherche($searchTerm['recherche']);
            $produits  = $this->get('knp_paginator')->paginate($findProduits,$request->query->get('page', 1),8);
            $categories = $em->getRepository('EcommerceBundle:Categories')->findBy(array(), array('id' => 'ASC'),4);

            foreach ($categories as $categorie)
            {
                $categorieid = $categorie->getId();
                $suggestions[$categorieid] = $em->getRepository('EcommerceBundle:Produits')->RandomProducts(4, $categorieid);

            }

        } else {
            throw $this->createNotFoundException('La page n\'existe pas.');
        }

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits,
                                                                                                 'suggestions' => $suggestions,
                                                                                                 'categories' => $categories));
    }
}