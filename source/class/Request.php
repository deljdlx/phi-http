<?php


namespace Phi\HTTP;


class Request extends Message
{

    const KEY_URI = 'REQUEST_URI';
    const KEY_PROTOCOL = 'REQUEST_PROTOCOL';
    const KEY_SERVER_NAME = 'SERVER_NAME';
    const KEY_REQUEST_METHOD = 'REQUEST_METHOD';
    const KEY_GET_ALL_HEADERS = 'getallheaders';


    protected $uri = null;
    protected $verb = null;

    protected $protocol = null;
    protected $normalizedProtocol = '';
    protected $serverVariables = array();

    protected $hostname;

    protected $postVariables =array();
    protected $getVariables =array();


    public function __construct($autobuild = true)
    {
        if($autobuild) {
          $this->autobuild();
        }
    }

    public function autobuild() {

        $this->serverVariables = $_SERVER;
        $this->postVariables = $_POST;
        $this->getVariables = $_GET;

        if (array_key_exists(static::KEY_URI, $_SERVER)) {
          $this->uri = $_SERVER[static::KEY_URI];
        }

        if (array_key_exists(static::KEY_PROTOCOL, $_SERVER)) {
          $this->protocol = $_SERVER[static::KEY_PROTOCOL];
          $this->normalizedProtocol = strtolower( preg_replace('`^(\w+).*`', '$1', $this->protocol));
        }

        if (array_key_exists(static::KEY_SERVER_NAME, $_SERVER)) {
          $this->hostname = static::KEY_SERVER_NAME;
        }

        if (array_key_exists(static::KEY_REQUEST_METHOD, $_SERVER)) {
          $this->verb = $_SERVER[static::KEY_REQUEST_METHOD];
        }

        if(function_exists(static::KEY_GET_ALL_HEADERS)) {
            $headers = getallheaders();
            foreach ($headers as $name => $value) {
              $header = new Header($name, $value);
              $this->addHeader($header);
            }
        }
        return $this;
    }

    public function post($variableName = null) {

        if($variableName === null) {
            return $this->postVariables;
        }

        if(array_key_exists($variableName, $this->postVariables)) {
            return $this->postVariables[$variableName];
        }
        return null;
    }

    public function get($variableName = null) {

        if($variableName === null) {
            return $this->getVariables;
        }

        if(array_key_exists($variableName, $this->getVariables)) {
            return $this->getVariables[$variableName];
        }
        return null;
    }


    public function getURI()
    {
        return $this->uri;
    }

    public function getURL() {
        return $this->normalizedProtocol.'://'.$this->hostname.$this->getURI();
    }


    public function setURI($uri)
    {
        $this->uri = $uri;
        return $this;
    }


    public function getVerb()
    {
        return $this->verb;
    }


}