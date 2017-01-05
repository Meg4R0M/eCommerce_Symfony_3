<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05/01/17
 * Time: 08:42
 */

namespace Ecommerce\EcommerceBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FacturesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('ecommerce:facture')
            ->setDescription('Ceci est un premier test')
            ->addArgument('date', InputArgument::OPTIONAL, 'Date pour laquelle vous souhaitez recuperer les factures');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $date = new \DateTime();
        $em = $this->getContainer()->get('doctrine')->getManager();
        $factures = $em->getRepository('EcommerceBundle:Commandes')->byDateCommand($input->getArgument('date'));

        $output->writeln(count($factures).' facture(s).');

        if (count($factures) > 0) {
            $dir = $date->format('d-m-Y h-i-s');
            mkdir('Facturation/'.$dir);

            foreach($factures as $facture) {
                $this->getContainer()->get('setNewFacture')->facture($facture)
                    ->Output('Facturation/'.$dir.'/facture'.$facture->getReference().'.pdf', 'F');
            }
        }
    }
}