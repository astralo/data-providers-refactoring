<?php

declare(strict_types=1);

namespace App\Responses\Formatters;

use SimpleXMLElement;

class XmlResponseFormatter extends ResponseFormatter implements ResponseFormatterInterface
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function format(array $data): string
    {
        $xml = new SimpleXMLElement('<root/>');

        array_walk_recursive($data, array($xml, 'addChild'));

        return $xml->asXML();
    }
}
