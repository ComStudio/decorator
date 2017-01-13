<?php

declare(strict_types=1);

namespace Acme\File\Video;

use Acme\File\UploadInterface;
use Acme\Helper\File;
use Acme\Helper\ThumbnailFromVideo;
use Acme\Storage\StorageInterface;

class VideoWithThumbnail implements UploadInterface
{
    protected $image;

    /**
     * VideoWithThumbnail constructor.
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
        $thumbnailFromVideo   = new ThumbnailFromVideo();

        $thumbnail = new File(
            $fileName . '_thumb',
            $file->getExtension(),
            $thumbnailFromVideo->create($file),
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
