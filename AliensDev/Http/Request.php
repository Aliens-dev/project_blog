<?php


namespace app\Http;


use GuzzleHttp\Psr7\ServerRequest;

class Request
{
    public $request;
    public $keys = [];
    public $type;
    public function __construct()
    {

        $this->request = ServerRequest::fromGlobals();
        $this->type = $this->request->getServerParams()['REQUEST_METHOD'];
        $this->getKeys();
    }

    private function getKeys() {
        $this->keys = array_keys($this->request->getParsedBody());
        foreach ($this->keys as $key) {
            $this->$key = $this->request->getParsedBody()[$key];
        }
    }

    public function method() {
        return $this->request->getMethod();
    }
}