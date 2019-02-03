<?php


namespace Afup\BarometreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PressReviewController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $reviews = $this->getParameter('press_reviews');

        return $this->render(
            'AfupBarometreBundle:PressReview:index.html.twig',
            ['press_review_by_year' => $reviews]
        );
    }
}
