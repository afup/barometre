<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PressReviewController extends AbstractController
{
    #[Route('/press_review', name: 'afup_barometre_press_review')]
    public function indexAction(): Response
    {
        $reviews = $this->getParameter('press_reviews');

        return $this->render('PressReview/index.html.twig', ['press_review_by_year' => $reviews]);
    }
}
