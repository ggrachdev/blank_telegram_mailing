<?php

namespace App\Parser;

/**
 * Данные полученные в результате парсинга
 */
class DataParsing {
    protected $data = [];
    
    public function getData(): array {
        return $this->data;
    }
    
    public function addData(string $data, array $arMetaData = [])
    {
        $this->data[] = [
            'data' => $data,
            'meta' => $arMetaData
        ];
    }
}
