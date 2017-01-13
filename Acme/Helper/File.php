<?php

declare(strict_types=1);

namespace Acme\Helper;

class File
{
    protected $name;
    protected $extension;
    protected $content;
    protected $path;
    protected $fullPath;

    /**
     * File constructor.
     *
     * @param $name
     * @param $extension
     * @param $content
     * @param $path
     */
    public function __construct($name, $extension, $content, $path)
    {
        $this->name = $name;
        $this->extension = $extension;
        $this->content = $content;
        $this->path = $path;

    }

    public static function CreateFromRequest($file)
    {
        return new File(
            $file->getClientOriginalName(),
            $file->getClientOriginalExtension(),
            \File::get($file->getRealPath()),
            $file->getRealPath()
        );
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }

    /**
     * @param mixed $fullPath
     */
    public function setFullPath($fullPath)
    {
        $this->fullPath = $fullPath;
    }
}
