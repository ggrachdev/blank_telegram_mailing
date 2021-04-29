<?php

namespace App\Parser;

use App\Parser\DataParsing;

/**
 * Description of DataParsingSerializer
 *
 * @author ggrachdev
 */
class DataParsingSerializer {

    public static function toFile(DataParsing $data, string $pathFile): bool {
        $result = false;
        
        if(\file_exists($pathFile))
        {
            
        }
        
        return $result;
    }

    public static function fromFile(string $pathFile): DataParsing {
        $dataParsing = new DataParsing();
        
        return $dataParsing;
    }

}
