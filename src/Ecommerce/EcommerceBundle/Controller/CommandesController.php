<?php

namespace Ecommerce\EcommerceBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Ecommerce\EcommerceBundle\Entity\UtilisateursAdresses;
use Ecommerce\EcommerceBundle\Entity\Commandes;
use Ecommerce\EcommerceBundle\Entity\Produits;
use JMS\SecurityExtraBundle\Annotation\Secure;

class CommandesController extends Controller
{
    public function facture()
    {
        $em = $this->getDoctrine()->getManager();
        $generator = $this->container->get('security.util.secure_random');
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $adresse = $session->get('adresse');
        $panier = $session->get('panier');
        $commande = array();
        $totalHT = 0;
        $totalTVA = 0;

        $facturation = $em->getRepository('EcommerceBundle:UtilisateursAdresses')->find($adresse['facturation']);
        $livraison = $em->getRepository('EcommerceBundle:UtilisateursAdresses')->find($adresse['livraison']);
        $produits = $em->getRepository('EcommerceBundle:Produits')->findArray(array_keys($session->get('panier')));

        foreach($produits as $produit) {
            $prixHT = ($produit->getPrix() * $panier[$produit->getId()]);
            $prixTTC = ($produit->getPrix() * $panier[$produit->getId()] / $produit->getTva()->getMultiplicate());
            $totalHT += $prixHT;

            if (!isset($commande['tva']['%' . $produit->getTva()->getValeur()])) {
                $commande['tva']['%' . $produit->getTva()->getValeur()] = round($prixTTC - $prixHT, 2);
            } else {
                $commande['tva']['%' . $produit->getTva()->getValeur()] += round($prixTTC - $prixHT, 2);
            }

            $totalTVA += round($prixTTC - $prixHT,2);

            $commande['produit'][$produit->getId()] = array('reference' => $produit->getNom(),
                'quantite' => $panier[$produit->getId()],
                'prixHT' => round($produit->getPrix(), 2),
                'prixTTC' => round($produit->getPrix() / $produit->getTva()->getMultiplicate(), 2));
        }

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
        $commande['prixTTC'] = round($totalHT + $totalTVA,2);
        $commande['token'] = bin2hex($generator->nextBytes(20));


        return $commande;
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
        $commande->setUtilisateur($this->container->get('security.token_storage')->getToken()->getUser());
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommandes($this->facture());

        if (!$session->has('commande'))
        {
            $em->persist($commande);
            $session->set('commande',$commande);
        }

        $em->flush();

        return new Response($commande->getId());
    }

    /*
     * Cette methode remplace l'API banque
     */
    public function validationCommandeAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('EcommerceBundle:Commandes')->find($id);

        if (!$commande || $commande->getValider() == 1)
        {
            throw $this->createNotFoundException('La commande n\'existe pas !');
        }

        $commande->setValider(1);
        $commande->setReference($this->container->get('setNewReference')->reference()); //Service a faire
        $em->flush();

        $session = $request->getSession();
        $session->remove('adresse');
        $session->remove('panier');
        $session->remove('commande');

        // ici le mail de validation
        $message = \Swift_Message::newInstance()
            ->setSubject('Validation de votre commande')
            ->setFrom(array('psykotero@gmail.com' => "Canturla"))
            ->setTo($commande->getUtilisateur()->getEmailCanonical())
            ->setCharset('utf-8')
            ->setContentType('text/html')
            ->setBody($this->renderView('EcommerceBundle:Default:SwiftLayout/validationCommande.html.twig',array('utilisateur' => $commande->getUtilisateur())));

        $this->get('mailer')->send($message);

        $this->get('session')->getFlashBag()->add('success','Votre commande est validée avec succès');
        return $this->redirect($this->generateUrl('factures'));
    }
}
