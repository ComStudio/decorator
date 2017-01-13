<?php

declare(strict_types=1);

namespace Acme\Helper;

class ThumbnailFromImage
{
    protected $height;

    /**
     * Resizer constructor.
     *
     * @param $height
     */
    public function __construct($height)
    {
        $this->height = $height;
    }

    public function create(File $file)
    {
        $content = $file->getContent();
        if ($content->height() >= $this->height) {
            $content->resize(null, $this->height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        return $content;
    }
}
