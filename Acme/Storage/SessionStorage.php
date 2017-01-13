<?php

declare(strict_types=1);

namespace Acme\Storage;

class SessionStorage implements StorageInterface, \Countable
{
    protected $file;

    public function __construct($file = 'default')
    {
        if (!isset($_SESSION[$file])) {
            $_SESSION[$file] = [];
        }

        $this->file = $file;
    }

    public function get($index)
    {
        if (!$this->has($index)) {
            return null;
        }

        return $_SESSION[$this->file][$index];
    }

    public function set($index, $value)
    {
        $_SESSION[$this->file][$index] = $value;
    }

    public function all()
    {
        return $_SESSION[$this->file];
    }

    public function has($index)
    {
        return isset($_SESSION[$this->file][$index]);
    }

    public function remove($index)
    {
        if ($this->has($index)) {
            unset($_SESSION[$this->file][$index]);
        }
    }

    public function clear()
    {
        unset($_SESSION[$this->file]);
    }

    public function count()
    {
        return count($this->all());
    }
}
