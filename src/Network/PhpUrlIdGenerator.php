<?php declare(strict_types=1);

namespace Semrush\HomeTest\Network;

use Semrush\HomeTest\Support\HelperTool;

final class PhpUrlIdGenerator extends AbstractUrlIdGenerator
{
    protected function generateId(string $url): string
    {
        //exit($url);
        //$url = 'http://google.de:8080/hh';

        $updatedUrl = base_convert(substr(sha1($url), 0, 16), 16, 10);


        //var_dump(sha1($url));
        //var_dump(substr(sha1($url), 0, 16));
        //var_dump(base_convert(substr(sha1($url), 0, 16), 16, 10));

        //Expected :'12737925248020764514'
        //Actual   :'12737925248020764862'

        return $updatedUrl;
    }

}
