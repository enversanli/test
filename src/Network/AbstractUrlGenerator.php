<?php

namespace Semrush\HomeTest\Network;

use Semrush\HomeTest\Support\HelperTool;

abstract class AbstractUrlGenerator implements UrlIdGenerator
{
    protected function generateNewId(string $url): string
    {
        try {
            //$url = 'http://www.arcticspas.co.uk/hot-tubs/arctic-yukon-hot-tub/';

            if (!$this->checkProtocol($url)) {
                $url = self::PROTOCOL_HTTP . $url;
            }

            //Remove Port
            $url = $this->removePort($url);

            // Generate ID
            $generatedId = $this->generateKey($url);

            // Expected : 14531297383758074632

        } catch (\Exception $exception) {
            // Log error
            HelperTool::logger($exception->getMessage());
        }

        return $generatedId;
    }

    protected function generateKey($url)
    {
        try {
            return base_convert(substr(sha1($url), 0, 16), 16, 10);
        } catch (\Exception $exception) {
            HelperTool::logger($exception->getMessage());
            return $url;
        }
    }

    /** Remove port from URL */
    private function removePort($url)
    {
        try {
            $protocol = $this->getProtocol($url);

            $actualPort = parse_url($url, PHP_URL_PORT);

            // If there is no port, go on
            if (!$actualPort)
                return $url;

            $defaultPort = $this->getDefaultPort($protocol);

            if ($actualPort == $defaultPort) {
                $url = \preg_replace("#:$defaultPort#", '', $url, 1);
            }
        } catch (\Exception $exception) {
            // Log error
            HelperTool::logger($exception->getMessage());
        }

        return $url;
    }

    /** Get URL's protocol */
    public function getProtocol($url)
    {
        try {
            return (0 === \strpos($url, self::PROTOCOL_HTTPS) ? self::PROTOCOL_HTTPS : self::PROTOCOL_HTTP);
        } catch (\Exception $exception) {
            // Log error
            HelperTool::logger($exception->getMessage());
            return $url;
        }
    }

    /** Get Default Port from URL */
    public function getDefaultPort($protocol)
    {
        try {
            return $protocol == self::PROTOCOL_HTTPS ? self::PORT_HTTPS : self::PORT_HTTP;
        } catch (\Exception $exception) {
            // Log error
            HelperTool::logger($exception->getMessage());
            return $protocol;
        }
    }

    public function checkProtocol($url)
    {
        try {
            $protocol = parse_url($url, PHP_URL_SCHEME);

            if (!empty($protocol))
                return true;

        } catch (\Exception $exception) {
            // Log error
            HelperTool::logger($exception->getMessage());
        }

        return false;
    }
}
