<?php

namespace App\Traits;

trait JsonUtil
{
    public function getJsonData($key = null)
    {
        $jsonData = json_decode($this->json, true);
        if (empty($jsonData)) {
            $jsonData = [];
        }
        if (!empty($key)) {
            if (array_key_exists($key, $jsonData)) {
                return $jsonData[$key];
            }
            return null;
        }
        return $jsonData;
    }

    public function setJsonData($key, $value)
    {
        $data       = $this->getJsonData();
        $data[$key] = $value;
        $this->json = json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function delJsonData($key)
    {
        $data = $this->getJsonData();
        unset($data[$key]);
        $this->json = json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
