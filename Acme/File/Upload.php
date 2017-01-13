<?php

declare(strict_types=1);

namespace Acme\File;

use Acme\Helper\File;
use Acme\Storage\StorageInterface;

class Upload implements UploadInterface
{

    protected $storage;

    /**
     * File constructor.
     *
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function save(File $file)
    {
        $fileName = $file->getName();
        if($this->storage->has($fileName))
        {
            $this->storage->remove($fileName);
        }

        $this->storage->set($fileName, [
            'content' =>  $file->getContent()
        ]);
    }

    /**
     * @return StorageInterface
     */
    public function getStorage()
    {
        return $this->storage;
    }
}
