<?php

namespace Semrush\HomeTest\Network;

use Semrush\HomeTest\Support\HelperTool;

class UrlGenerator implements UrlIdGenerator
{
    public function generate(string $url): string
    {
        try {

            $url = $this->removePort($url);

            $updatedUrl = base_convert(substr(sha1($url), 0, 16), 16, 10);

        } catch (\Exception $exception) {
            file_put_contents('logs.txt', HelperTool::logger($exception->getMessage()) . PHP_EOL, FILE_APPEND | LOCK_EX);

        }

        return $updatedUrl;
    }

    /** Remove port from URL */
    private function removePort($url)
    {
        try {
            $protocol = $this->getProtocol($url);

            $actualPort = parse_url($url, PHP_URL_PORT);
            $defaultPort = $this->getDefaultPort($protocol);

            if ($actualPort == $defaultPort) {
                $url = \preg_replace("#:$defaultPort#", '', $url, 1);
            }

            return $url;
        } catch (\Exception $exception) {
            // Log error
            file_put_contents('logs.txt', HelperTool::logger($exception->getMessage()) . PHP_EOL, FILE_APPEND | LOCK_EX);

            return $url;
        }


    }

    /** Get URL's protocol */
    private function getProtocol($url)
    {
        try {
            return (0 === \strpos($url, self::PROTOCOL_HTTPS) ? self::PROTOCOL_HTTPS : self::PROTOCOL_HTTP);
        } catch (\Exception $exception) {
            // Log error
            file_put_contents('logs.txt', HelperTool::logger($exception->getMessage()) . PHP_EOL, FILE_APPEND | LOCK_EX);

            return $url;
        }
    }

    /** Get Default Port from URL */
    private function getDefaultPort($protocol)
    {
        try {
            return $protocol == self::PROTOCOL_HTTPS ? self::PORT_HTTPS : self::PORT_HTTP;
        } catch (\Exception $exception) {
            // Log error
            file_put_contents('logs.txt', HelperTool::logger($exception->getMessage()) . PHP_EOL, FILE_APPEND | LOCK_EX);

            return $protocol;
        }
    }
}
