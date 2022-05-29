<?php declare(strict_types=1);

namespace Semrush\HomeTest\Network;

final class PhpUrlIdGenerator extends AbstractUrlIdGenerator
{
    protected function generateId(string $url): string
    {
        //exit($url);
        //$url = 'http://google.de:8080/hh';

        $url = 'http://google.de:8080/hh';

        $url = sha1($url);
        $url = substr($url, 0 , 16);
        $url = convB($url, 16,10);
        exit($url);

        var_dump('>' . $url);
        $updatedUrl = base_convert(substr(sha1($url), 0, 16), 16, 10);



        //var_dump(sha1($url));
        //var_dump(substr(sha1($url), 0, 16));
        //var_dump(base_convert(substr(sha1($url), 0, 16), 16, 10));

        //Expected :'12737925248020764514'
        //Actual   :'12737925248020764862'

        //var_dump(" ---> " . $updatedUrl);
        //exit();
        return $updatedUrl;
    }
    function convBase($numberInput, $fromBaseInput, $toBaseInput)
    {
        if ($fromBaseInput==$toBaseInput) return $numberInput;
        $fromBase = str_split($fromBaseInput,1);
        $toBase = str_split($toBaseInput,1);
        $number = str_split($numberInput,1);
        $fromLen=strlen($fromBaseInput);
        $toLen=strlen($toBaseInput);
        $numberLen=strlen($numberInput);
        $retval='';
        if ($toBaseInput == '0123456789')
        {
            $retval=0;
            for ($i = 1;$i <= $numberLen; $i++)
                $retval = bcadd($retval, bcmul(array_search($number[$i-1], $fromBase),bcpow($fromLen,$numberLen-$i)));
            return $retval;
        }
        if ($fromBaseInput != '0123456789')
            $base10=convBase($numberInput, $fromBaseInput, '0123456789');
        else
            $base10 = $numberInput;
        if ($base10<strlen($toBaseInput))
            return $toBase[$base10];
        while($base10 != '0')
        {
            $retval = $toBase[bcmod($base10,$toLen)].$retval;
            $base10 = bcdiv($base10,$toLen,0);
        }
        return $retval;
    }
    public function generateUrl(): string
    {
        // TODO: Implement generateUrl() method.
    }
}
