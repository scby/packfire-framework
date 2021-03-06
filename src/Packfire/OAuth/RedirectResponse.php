<?php

/**
 * Packfire Framework for PHP
 * By Sam-Mauris Yong
 * 
 * Released open source under New BSD 3-Clause License.
 * Copyright (c) Sam-Mauris Yong <sam@mauris.sg>
 * All rights reserved.
 */

namespace Packfire\OAuth;

use Packfire\Response\RedirectResponse as Response;
use Packfire\Net\Http\Url;

/**
 * This response is meant to be sent to the consumer's browser to redirect
 * the user to the service provider.
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\OAuth
 * @since 1.1-sofia
 */
class RedirectResponse extends Response {

    /**
     * Create a new RedirectResponse
     * @param string|Url $url The service provider authentication URL to redirect to
     * @param string $token The access token that was granted by the service provider
     * @since 1.1-sofia
     */
    function __construct($url, $token) {
        if(!($url instanceof Url)){
            $url = new Url($url);
        }
        $url->params()->add(OAuth::TOKEN, $token);
        parent::__construct($url);
    }

}