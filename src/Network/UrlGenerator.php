<?php

namespace Semrush\HomeTest\Network;

use Semrush\HomeTest\Support\HelperTool;

class UrlGenerator implements UrlIdGenerator
{
    public function generate(string $url): string
    {
        try {
            $url = 'https://enversanli.com';

            if ($this->checkProtocol($url)) {
                $url = $this->removePort($url);
            }

            $updatedUrl = $this->generateId($url);

        } catch (\Exception $exception) {
            // Log error
            HelperTool::logger($exception->getMessage());
        }

        return $updatedUrl;
    }

    public function generateId($url)
    {
        try {
            return base_convert(substr(sha1($url), 0, 16), 16, 10);
        } catch (\Exception $exception) {
            HelperTool::logger($exception->getMessage());
            return $url;
        }
    }

    /** Remove port from URL */
    public function removePort($url)
    {
        try {
            $protocol = $this->getProtocol($url);

            $actualPort = parse_url($url, PHP_URL_PORT);
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

            return false;
        } catch (\Exception $exception) {
            // Log error
            HelperTool::logger($exception->getMessage());

            return false;
        }
    }
}
