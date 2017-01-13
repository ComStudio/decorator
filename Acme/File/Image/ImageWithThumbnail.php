<?php

declare(strict_types=1);

namespace Acme\File\Image;

use Acme\File\UploadInterface;
use Acme\Helper\File;
use Acme\Helper\ThumbnailFromImage;
use Acme\Storage\StorageInterface;

class ImageWithThumbnail implements UploadInterface
{
    protected $image;

    /**
     * ImageWithThumbnail constructor.
     *
     * @param UploadInterface $image
     */
    public function __construct(UploadInterface $image)
    {
        $this->image = $image;
    }

    public function save(File $file)
    {
        $this->image->save($file);

        $storage   = $this->getStorage();
        $fileName  = $file->getName();
        $thumbnailFromImage = new ThumbnailFromImage(150);

        $thumbnail = new File(
            $fileName . '_thumb',
            $file->getExtension(),
            $thumbnailFromImage->create($file),
            $file->getPath()
        );

        if($storage->has($fileName))
        {
            $image = $storage->get($fileName);

            $image['thumbnail'] = $thumbnail;
        }
    }

    /**
     * @return StorageInterface
     */
    public function getStorage()
    {
        return $this->image->getStorage();
    }
}
