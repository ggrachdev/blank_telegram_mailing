<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController {

    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request) {

        if ($_SERVER['DEBUG_SECRET_KEY'] === $request->get('key')) {

            
        
        dd($this->getContainer()->get('kernel')->getRootDir());
//            $parser = new \App\Parser\Parser();
//            $resultParsing = $parser->parse();
//            DataParsingSerializer::toFile($resultParsing, $_SERVER['DOCUMENT_ROOT'] . '/../var/parsing/data.txt');
        }
    }

}
