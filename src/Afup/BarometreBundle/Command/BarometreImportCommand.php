<?php

namespace Afup\BarometreBundle\Command;

use Afup\BarometreBundle\Campaign\Format\FormatFactory;
use Afup\BarometreBundle\Campaign\Importer\CampaignImporter;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BarometreImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName("barometre:imports")
            ->setDescription("Importe une nouvelle campagne")
            ->addOption('format', 'f', InputOption::VALUE_REQUIRED, 'Format du fichier ("2013" ou "2014")')
            ->addArgument('name', InputArgument::REQUIRED, 'Nom de la campagne')
            ->addArgument('startDate', InputArgument::REQUIRED, 'Date de début de la campagne (format: dd/mm/yyyy)')
            ->addArgument('endDate', InputArgument::REQUIRED, 'Date de fin de la campagne (format: dd/mm/yyyy)')
            ->addArgument('filename', InputArgument::REQUIRED, 'Fichier à importer');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name       = $input->getArgument('name');
        $startDate  = $input->getArgument('startDate');
        $endDate    = $input->getArgument('endDate');
        $filename   = $input->getArgument('filename');

        $formatFactory = new FormatFactory();
        $format = $formatFactory->createFromCode($input->getOption('format'));

        $importer = $this->getCampaignImporter();
        $importer->import(
            $format,
            $name,
            \DateTime::createFromFormat('d/m/Y', $startDate),
            \DateTime::createFromFormat('d/m/Y', $endDate),
            $filename
        );
    }

    /**
     * @return CampaignImporter
     */
    protected function getCampaignImporter()
    {
        return $this->getContainer()->get('afup.barometre.campaign.importer');
    }
}
