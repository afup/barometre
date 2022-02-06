<?php

declare(strict_types=1);

namespace App\Controller;

use App\Report\AlterableReportInterface;
use App\ReportManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends AbstractController
{
    public function indexAction(RequestStack $requestStack, Request $request, string $reportName): Response
    {
        $masterRequest = $requestStack->getMainRequest();

        $manager = $this->getManager();
        $manager->handleRequest($masterRequest);

        $report = $manager->getReport($reportName);

        $report->execute();

        $childReports = [];
        foreach ($report->getChildReports() as $childReport) {
            if ($childReport instanceof AlterableReportInterface) {
                $request = clone $masterRequest;
                $childReport->alterRequest($request);
            }

            $childManager = $this->getManager();
            $childManager->handleRequest($request);

            $childReport->setQueryBuilder($childManager->createBaseQueryBuilder());
            $childReport->execute();
            $childReports[] = [
                'filters' => $childManager->getSelectedFilters(),
                'report' => $childReport,
            ];
        }

        return $this->render('Report/index.html.twig', [
            'form' => $manager->getForm()->createView(),
            'filters' => $manager->getSelectedFilters(),
            'report' => $report,
            'child_reports' => $childReports,
        ]);
    }

    /*
     * Le ReportManager est un service non partagé (shared=false dans la définition)
     * ce qui veut dire qu'on en récupère une nouvelle instance à chaque fois qu'on la demande au container
     * Ceci afin de pouvoir valider autant de fois le formulaire qu'il y a dedans ($form)
     * (on ne peut donc pas passer par l'injection de dépendances dans le constructeur du controller)
     * Cela sert par exemple pour le rapport "Salaire Moyen Par Sexe" d'afficher en sous rapport des autres rapports
     * qui n'ont pas le même filtrage (concerne toutes les campagnes)
     * ->get est déprécié, il faudra voir comment on pourra remplacer cette méthode.
     */
    private function getManager()
    {
        return $this->get(ReportManager::class);
    }

    /*
     * Bien que défini comme publique dans la définition (public=true), cette méthode indique à l'AbstractController
     * qu'on peut appeler directement le service App\ReportManager via le container
     */
    public static function getSubscribedServices()
    {
        return array_merge(parent::getSubscribedServices(), [
            'App\ReportManager' => 'App\ReportManager',
        ]);
    }
}
