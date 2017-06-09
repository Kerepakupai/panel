<?php
namespace Panel;

class HelloWorld
{
    protected $message;

    public function setMessage($value)
    {
        $this->message = $value;
    }

    public function showMessage()
    {
        return $this->message;
    }
}