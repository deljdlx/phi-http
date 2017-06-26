<?php


namespace Phi\HTTP;


class Message
{

    /**
     * @var Header[]
     */
    protected $headers = array();

    /**
     * @return Header[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }


    /**
     * @param null $nameOrHeader
     * @param null $value
     * @return $this
     */
    public function addHeader($nameOrHeader = null, $value = null)
    {
        if ($nameOrHeader instanceof Header) {
            $name = $nameOrHeader->getName();
            $value = $nameOrHeader->getValue();
        } else {
            $name = $nameOrHeader;
        }

        $header = new Header($name, $value);
        $this->headers[$name] = $header;
        return $this;

    }
}