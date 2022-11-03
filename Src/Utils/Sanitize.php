<?php

namespace Utils;

class Sanitize 
{
    public function cleanData(string $string): string
    {
        $data = strip_tags($string);
        $data = htmlspecialchars($data);

        return $data;
    }
}