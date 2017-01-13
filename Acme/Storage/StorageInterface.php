<?php

declare(strict_types=1);

namespace Acme\Storage;

interface StorageInterface
{
    public function get($index);
    public function set($index, $value);
    public function all();
    public function has($index);
    public function remove($index);
}
