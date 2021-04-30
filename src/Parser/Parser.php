<?php

namespace App\Parser;

use App\Parser\DataParsing;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Парсит данные с ресурса
 */
class Parser {

    public static function parse($delay = 2): DataParsing {
        $resultParsing = new DataParsing();

        $urlSite = 'https://citaty.info/category/motiviruyushie-citaty';

        $page = 0;

        \set_time_limit(600);

        while (true) {

            $ch = \curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlSite . '?page=' . $page);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $html = \curl_exec($ch);

            sleep($delay);

            if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
                break;
            }

            curl_close($ch);

            $crawler = new Crawler($html);
            $crawler = $crawler->filter('body .node__content .field-name-body .field-item.even.last');

            if ($crawler->count() == 0) {
                break;
            }

            foreach ($crawler as $domElement) {
                $innerHTML = '';

                if (!empty($domElement->childNodes)) {

                    foreach ($domElement->childNodes as $child) {
                        $innerHTML .= $domElement->ownerDocument->saveHTML($child);
                    }
                }

                if (empty($innerHTML)) {
                    break 2;
                } else {
                    $resultParsing->addData(\strip_tags($innerHTML), [
                        'page' => ($page + 1)
                    ]);
                }
            }
            $page++;

            if ($page > 300) {
                break;
            }
        }

        return $resultParsing;
    }

}
