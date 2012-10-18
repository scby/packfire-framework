<?php
namespace Packfire\Database\Drivers\Mongo;

use Packfire\Database\IConnector;
use Packfire\Exception\MissingDependencyException;

if(!class_exists('Mongo')){
    throw new MissingDependencyException('Mongo requires the Mongo extension in order to run properly.');
}

class Connector implements IConnector {
    
    private $mongo;

    /**
     * The array of configuration
     * @var array|Map
     * @since 2.0.0
     */
    protected $config;
    
    public function __construct($config) {
        $this->config = $config;
        $this->mongo = new Mongo($config['dsn']);
    }

    public function database(){
        $database = new Database($this);
        if(isset($this->config['dbname']) && $this->config['dbname']){
            $database = $database->select($this->config['dbname']);
        }
        return $database;
    }
    
}
