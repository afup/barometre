<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PressReviewController extends Controller
{
    /**
     * @Route("/press_review", name="afup_barometre_press_review")
     *
     * @return Response
     */
    public function indexAction()
    {
        $reviews = $this->getParameter('press_reviews');

        return $this->render('@AfupBarometre/PressReview/index.html.twig', ['press_review_by_year' => $reviews]);
    }
}
