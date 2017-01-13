<?php

declare(strict_types=1);

namespace Acme\File;

use Acme\Helper\File;
use Acme\Storage\StorageInterface;

interface UploadInterface
{
    public function save(File $file);

    /**
     * @return StorageInterface
     */
    public function getStorage();
}
