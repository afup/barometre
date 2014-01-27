<?php

namespace Afup\BarometreBundle\Campaign\Importer;

use Afup\BarometreBundle\Campaign\ResponseFactory;
use Afup\BarometreBundle\Campaign\ResponseFormat;
use Afup\BarometreBundle\Entity\Campaign;
use Doctrine\Common\Persistence\ObjectManager;
use SplFileObject;

class CampaignImporter
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @param ObjectManager   $objectManager
     * @param ResponseFactory $responseFactory
     */
    public function __construct(ObjectManager $objectManager, ResponseFactory $responseFactory)
    {
        $this->objectManager   = $objectManager;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param string $name
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param string $filename
     */
    public function import($name, \DateTime $startDate, \DateTime $endDate, $filename)
    {
        $campaign = new Campaign();
        $campaign
            ->setName($name)
            ->setStartDate($startDate)
            ->setEndDate($endDate);

        $this->objectManager->persist($campaign);

        $file = new SplFileObject($filename, 'r');
        $file->setCsvControl(";");
        $file->setFlags(
            SplFileObject::READ_AHEAD
            | SplFileObject::READ_CSV
            | SplFileObject::SKIP_EMPTY
            | SplFileObject::DROP_NEW_LINE
        );

        $format = new ResponseFormat();
        $columns = $format->getColumns();

        foreach ($file as $lineNumber => $line) {
            //skip first line
            if (0 === $lineNumber) {
                continue;
            }

            $data = array_combine($columns, $line);
            $response = $this->responseFactory->createResponse($data, $campaign);
            $this->objectManager->persist($response);
        }

        $this->objectManager->flush();
    }
}
