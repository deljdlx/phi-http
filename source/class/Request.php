<?php


namespace Phi\HTTP;


class Request extends Message
{


    protected $uri = null;
    protected $method = null;

    protected $protocol = null;
    protected $normalizedProtocol = '';
    protected $variables = array();

    protected $hostname;


    public function __construct($autobuild = true)
    {
        if($autobuild) {
          $this->autobuild();
        }
    }

    public function autobuild() {

        $this->variables['server'] = $_SERVER;

        if (array_key_exists('REQUEST_URI', $_SERVER)) {
          $this->uri = $_SERVER['REQUEST_URI'];
        }

        if (array_key_exists('SERVER_PROTOCOL', $_SERVER)) {
          $this->protocol = $_SERVER['SERVER_PROTOCOL'];
          $this->normalizedProtocol = strtolower( preg_replace('`^(\w+).*`', '$1', $this->protocol));
        }

        if (array_key_exists('SERVER_NAME', $_SERVER)) {
          $this->hostname = $_SERVER['SERVER_NAME'];
        }

        if (array_key_exists('REQUEST_METHOD', $_SERVER)) {
          $this->method = $_SERVER['REQUEST_METHOD'];
        }

        if(function_exists('getallheaders')) {
            $headers = getallheaders();
            foreach ($headers as $name => $value) {
              $header = new Header($name, $value);
              $this->addHeader($header);
            }
        }
        return $this;
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

}