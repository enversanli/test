<?php

namespace Semrush\HomeTest\Network;

class UrlGenerator implements UrlIdGenerator
{
    public function generate(string $url): string
    {
        $updatedUrl = base_convert(substr(sha1($url), 0, 16), 16, 10);

        return $updatedUrl;
    }


    private function getPort(){

    }
}
