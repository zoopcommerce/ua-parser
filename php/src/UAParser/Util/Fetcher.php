<?php

/**
 * ua-parser
 *
 * Copyright (c) 2011-2012 Dave Olsen, http://dmolsen.com
 *
 * Released under the MIT license
 */

namespace UAParser\Util;

use UAParser\Exception\FetcherException;

class Fetcher
{
    const RESOURCE_FILE = 'regexes.yaml';

    private $resourceUri;

    public function __construct()
    {
        $this->resourceUri = __DIR__ . '/../../../../' . self::RESOURCE_FILE;
    }

    public function fetch()
    {
        $level = error_reporting(0);
        $result = file_get_contents($this->resourceUri);
        error_reporting($level);

        if ($result === false) {
            $error = error_get_last();
            throw FetcherException::httpError($this->resourceUri, $error['message']);
        }

        return $result;
    }
}
