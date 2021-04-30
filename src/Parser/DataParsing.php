<?php

namespace App\Parser;

/**
 * Данные полученные в результате парсинга
 */
class DataParsing {
    protected $data = [];
    protected $count = 0;
    
    public function getData(): array {
        return $this->data;
    }
    
    public function getCount() {
        return $this->count;
    }

    public function addData(string $data, array $arMetaData = [])
    {
        $this->count++;
        $this->data[] = [
            'data' => $data,
            'meta' => $arMetaData
        ];
    }
}
