<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Entity\Commandes;
use Ecommerce\EcommerceBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Ecommerce\EcommerceBundle\Entity\UtilisateursAdresses;

class CommandesController extends Controller
{
    public function facture($session)
    {
        $em = $this->getDoctrine()->getManager();
        //$generator = $this->container->get('security.SecureRandomInterface');
        //$session = $request->getSession();
        $adresse = $session->get('adresse');
        $panier = $session->get('panier');
        $commande = array();
        $totalHT = 0;
        $totalTTC= 0;

        $facturation = $em->getRepository('EcommerceBundle:UtilisateursAdresses')->find($adresse['facturation']);
        $livraison = $em->getRepository('EcommerceBundle:UtilisateursAdresses')->find($adresse['livraison']);
        $produits = $em->getRepository('EcommerceBundle:Produits')->findArray(array_keys($session->get('panier')));

        foreach($produits as $produit)
        {
            $prixHT = ($produit->getPrix() * $panier[$produit->getId()]);
            $prixTTC = ($produit->getPrix() * $panier[$produit->getId()] / $produit->getTva()->getMultiplicate());
            $totalHT += $prixHT;
            $totalTTC += $prixTTC;

            if (!isset($commande['tva']['%'.$produit->getTva()->getValeur()]))
            {
                $commande['tva']['%'.$produit->getTva()->getValeur()] = round($prixTTC - $prixHT,2);
            } else {
                $commande['tva']['%'.$produit->getTva()->getValeur()] += round($prixTTC - $prixHT,2);
            }

            $commande['produit'][$produit->getId()] = array('reference' => $produit->getNom(),
                                                            'quantite' => $panier[$produit->getId()],
                                                            'prixHT' => round($produit->getPrix(),2),
                                                            'prixTTC' => round($produit->getPrix() / $produit->getTva()->getMultiplicate(),2));

            $commande['livraison'] = array('prenom' => $livraison->getPrenom(),
                                           'nom' => $livraison->getNom(),
                                           'telephone' => $livraison->getTelephone(),
                                           'adresse' => $livraison->getAdresse(),
                                           'cp' => $livraison->getCP(),
                                           'ville' => $livraison->getVille(),
                                           'pays' => $livraison->getPays(),
                                           'complement' => $livraison->getComplement());

            $commande['facturation'] = array('prenom' => $facturation->getPrenom(),
                                             'nom' => $facturation->getNom(),
                                             'telephone' => $facturation->getTelephone(),
                                             'adresse' => $facturation->getAdresse(),
                                             'cp' => $facturation->getCP(),
                                             'ville' => $facturation->getVille(),
                                             'pays' => $facturation->getPays(),
                                             'complement' => $facturation->getComplement());

            $commande['prixHT'] = round($totalHT,2);
            $commande['prixTTC'] = round($totalTTC,2);
            //$commande['token'] = bin2hex($generator->nextBytes(20));

            return $commande;
            // verification faite c'est ok, le var_dump de commande renvoi bien les données
        }
    }

    public function prepareCommandeAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        if (!$session->has('commande'))
        {
            $commande = new Commandes();
        } else {
            $commande = $em->getRepository('EcommerceBundle:Commandes')->find($session->get('commande'));
        }

        $commande->setDate(new \DateTime());
        //$commande->setUtilisateur($this->container->get('security.token_storage')->getToken()->getUser());
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommandes($this->facture($session));
        var_dump($commande);
        die('testouille');

        if (!$session->has('commande'))
        {
            $em->persist($commande);
            $session->set('commande',$commande);
        }

        $em->flush();

        return new Response($commande->getId());
    }
}
