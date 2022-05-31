<?php

namespace Semrush\HomeTest\Tests\Http;

use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class IdGeneratorTest extends TestCase
{


    /**
     * @test
     */
    public function generate(){
        $client = new \GuzzleHttp\Client();

        $response = $client->post('http://semrush2.test/upload');

        print_r($response->getBody()->getContents());

        $this->assertEquals('sivas', 'sivas');
    }
}
