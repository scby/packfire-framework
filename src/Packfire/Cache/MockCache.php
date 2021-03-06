<?php

/**
 * Packfire Framework for PHP
 * By Sam-Mauris Yong
 * 
 * Released open source under New BSD 3-Clause License.
 * Copyright (c) Sam-Mauris Yong <sam@mauris.sg>
 * All rights reserved.
 */

namespace Packfire\Cache;

use Packfire\Cache\ICache;
use Packfire\Collection\Map;

/**
 * MockCache class
 * 
 * Provides functionality for cache mocking
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Cache
 * @since 1.0-sofia
 */
class MockCache implements ICache {
    
    /**
     * The cache storage
     * @var Map
     * @since 1.0-sofia
     */
    private $store;
    
    /**
     * Create a new MockCache object
     * @since 1.0-sofia
     */
    public function __construct(){
        $this->store = new Map();
    }
    
    /**
     * Check if a cache value identified by the identifier is still fresh,
     *      available and has yet to expire. 
     * @param string $cacheId The identifier of the cache value
     * @return boolean Returns true if the cache value is fresh, available and
     *          has yet to expire. Returns false otherwise.
     * @since 1.0-sofia
     */
    public function check($cacheId) {
        return $this->store->keyExists($cacheId);
    }

    /**
     * Remove the cache value identified by the identifier
     * @param string $cacheId The identifier of the cache value
     * @since 1.0-sofia
     */
    public function clear($cacheId) {
        $this->store->removeAt($cacheId);
    }

    /**
     * Remove all cache values regardless of their state.
     * @since 1.0-sofia 
     */
    public function flush() {
        $this->store->clear();
    }

    /**
     * Perform garbage collection to remove all expired and stale cache values 
     * @since 1.0-sofia
     */
    public function garbageCollect() {
        
    }

    /**
     * Retrieve the fresh cache value identified by the identifier if the
     *          cache is fresh, available and yet to expire.
     * @param string $cacheId The identifier of the cache value
     * @param mixed $default (optional) The default value to return if the cache
     *          is stale, unavailable or expired. Defaults to null.
     * @return mixed Returns the fresh cache value or default value.
     * @since 1.0-sofia
     */
    public function get($cacheId, $default = null) {
        return $this->store->get($cacheId, $default);
    }

    /**
     * Store the cache value uniquely identified by the identifier with expiry
     * @param string $cacheId The identifier of the cache value
     * @param mixed $value The cache value to store
     * @param DateTime|TimeSpan $expiry (optional) The date time or period of 
     *          time to expire the cache value. If not set, the item will 
     *          never expire.
     * @since 1.0-sofia
     */
    public function set($cacheId, $value, $expiry = null) {
        $this->store->add($cacheId, $value);
    }
    
}