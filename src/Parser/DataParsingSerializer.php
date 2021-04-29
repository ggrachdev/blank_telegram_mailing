<?php

namespace App\Parser;

use App\Parser\DataParsing;

/**
 * Description of DataParsingSerializer
 *
 * @author ggrachdev
 */
class DataParsingSerializer {

    public static function toFile(DataParsing $dataParsing, string $pathFile): bool {
        $result = false;
        
        if(\file_exists($pathFile) && \is_writable($pathFile))
        {
            $result = \file_put_contents(
                $pathFile, 
                \json_encode($dataParsing->getData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                );
        }
        
        return $result;
    }

    public static function fromFile(string $pathFile): DataParsing {
        $dataParsing = new DataParsing();
        
        $data = json_decode(\file_get_contents($pathFile), true);
        
        if(!empty($data)) {
            foreach ($data as $arDataFile) {
                $dataParsing->addData($arDataFile['data'], $arDataFile['meta']);
            }
        }
        
        
        return $dataParsing;
    }

}
