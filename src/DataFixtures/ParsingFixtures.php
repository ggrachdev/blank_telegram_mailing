<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\MailingData;
use App\Parser\DataParsingSerializer;

class ParsingFixtures extends Fixture {

    public function load(ObjectManager $manager) {
        $dataParsing = DataParsingSerializer::fromFile(__DIR__ . '/../../var/parsing/data.txt');

        if (!empty($dataParsing->getData())) {
            foreach ($dataParsing->getData() as $arData) {
                $mailingData = new MailingData();

                if (!empty($arData['data'])) {
                    $mailingData->setMessage($arData['data']);

                    if (!empty($arData['meta'])) {
                        $mailingData->setMeta($arData['meta']);
                    }
                    
                    $manager->persist($mailingData);
                }
            }

            $manager->flush();
        }
    }

}
