<?php


namespace Phi\HTTP;


class Request extends Message
{


    protected $uri = null;
    protected $protocol = null;
    protected $values = array();

    public function __construct(array $values = null)
    {

        if ($values === null) {
            $this->values = $_SERVER;

            if (array_key_exists('REQUEST_URI', $_SERVER)) {
                $this->uri = $_SERVER['REQUEST_URI'];
            }

            if (array_key_exists('SERVER_PROTOCOL', $_SERVER)) {
                $this->protocol = $_SERVER['SERVER_PROTOCOL'];
            }

        } else {
            $this->values = $values;
        }
    }

    public function getURI()
    {
        return $this->uri;
    }


    public function setURI($uri)
    {
        $this->uri = $uri;
        return $this;
    }

}