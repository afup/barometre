<?php

declare(strict_types=1);

namespace App\Command;

use App\Campaign\Format\FormatFactory;
use App\Campaign\Importer\CampaignImporter;
use App\Repository\CampaignRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BarometreImportCommand extends Command
{
    /** @var CampaignRepository */
    private $campaignRepository;

    /** @var CampaignImporter */
    private $campaignImporter;

    public function __construct(CampaignRepository $campaignRepository, CampaignImporter $campaignImporter)
    {
        parent::__construct();

        $this->campaignRepository = $campaignRepository;
        $this->campaignImporter = $campaignImporter;
    }

    protected function configure()
    {
        $this
            ->setName('barometre:imports')
            ->setDescription('Importe une nouvelle campagne')
            ->addOption('format', 'f', InputOption::VALUE_REQUIRED, 'Format du fichier ("2013" ou "2014")')
            ->addOption('separator', '', InputOption::VALUE_OPTIONAL, 'separateur csv (";" par défaut)', ';')
            ->addArgument('name', InputArgument::REQUIRED, 'Nom de la campagne')
            ->addArgument('startDate', InputArgument::REQUIRED, 'Date de début de la campagne (format: dd/mm/yyyy)')
            ->addArgument('endDate', InputArgument::REQUIRED, 'Date de fin de la campagne (format: dd/mm/yyyy)')
            ->addArgument('filename', InputArgument::REQUIRED, 'Fichier à importer');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $startDate = $input->getArgument('startDate');
        $endDate = $input->getArgument('endDate');
        $filename = $input->getArgument('filename');
        $separator = $input->getOption('separator');

        $formatFactory = new FormatFactory();
        $format = $formatFactory->createFromCode($input->getOption('format'));

        $this->getCampaignRepository()->removeCampaign($name);

        $this->getCampaignImporter()->import(
            $format,
            $name,
            \DateTime::createFromFormat('d/m/Y', $startDate),
            \DateTime::createFromFormat('d/m/Y', $endDate),
            $filename,
            $separator
        );

        return Command::SUCCESS;
    }

    /**
     * @return CampaignImporter
     */
    protected function getCampaignImporter()
    {
        return $this->campaignImporter;
    }

    /**
     * @return CampaignRepository
     */
    protected function getCampaignRepository()
    {
        return $this->campaignRepository;
    }
}
