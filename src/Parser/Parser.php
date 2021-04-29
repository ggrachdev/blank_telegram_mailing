<?php

namespace App\Parser;

use App\Parser\DataParsing;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Парсит данные с ресурса
 */
class Parser {

    public static function parse(): DataParsing {
        $resultParsing = new DataParsing();

        $html = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <p class="message">Hello World!</p>
        <p>Hello Crawler!</p>
    </body>
</html>
HTML;

        $crawler = new Crawler($html);
        foreach ($crawler as $domElement) {
            dd($domElement->nodeName);
        }

        return $resultParsing;
    }

}
