<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Parser\DataParsingSerializer;

class IndexController extends AbstractController {

    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request) {

        if ($_SERVER['DEBUG_SECRET_KEY'] === $request->get('key')) {
            $repository = $this->getDoctrine()->getRepository(\App\Entity\MailingData::class);
            $mail = $repository->getRandomElement();

       


            die;
        }
    }

}
