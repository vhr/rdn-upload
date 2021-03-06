<?php

namespace RdnUpload\Object;

use DateTime;
use Gaufrette\File as GFile;

class Gaufrette implements ObjectInterface
{
    /**
     * @var GFile
     */
    private $file;

    /**
     * @var string
     */
    protected $publicPath;

    /**
     * @param GFile $file
     * @param string $publicPath
     */
    public function __construct(GFile $file, $publicPath)
    {
        $this->file = $file;
        $this->publicPath = str_replace(DIRECTORY_SEPARATOR, '/', $publicPath);
    }

    /**
     * Get the public URL to the file.
     *
     * @return string
     */
    public function getPublicUrl()
    {
        return $this->publicPath .'/'. $this->file->getName();
    }

    public function getContent()
    {
        return $this->file->getContent();
    }

    public function getBasename()
    {
        return basename($this->file->getName());
    }

    public function getExtension()
    {
        return pathinfo($this->file->getName(), PATHINFO_EXTENSION);
    }

    public function getContentLength()
    {
        return $this->file->getSize();
    }

    public function getLastModified()
    {
        return new DateTime('@'. $this->file->getMtime());
    }

    public function __toString()
    {
        return $this->getPublicUrl();
    }
}
