<?php
pload('pException');
pload('packfire.net.http.pHttpResponseCode');

/**
 * pAuthenticationException class
 * 
 * An authentication exception
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package packfire.exception
 * @since 1.0-sofia
 */
class pAuthenticationException extends pException {
    
    public function __construct($message, $code = null) {
        $this->responseCode = pHttpResponseCode::HTTP_403;
        parent::__construct($message, $code);
    }
    
}