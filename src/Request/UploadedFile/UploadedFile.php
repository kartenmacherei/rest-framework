<?php
namespace Kartenmacherei\RestFramework\Request\UploadedFile;

class UploadedFile
{
    /**
     * @var string
     */
    private $originalFilename = '';

    /**
     * @var string
     */
    private $mimeType = '';

    /**
     * @var int
     */
    private $size = 0;

    /**
     * @var string
     */
    private $temporaryFilename = '';

    /**
     * @param string $originalFilename
     * @param string $mimeType
     * @param int $size
     * @param string $temporaryFilename
     */
    public function __construct($originalFilename, $mimeType, $size, $temporaryFilename)
    {
        $this->originalFilename = $originalFilename;
        $this->mimeType = $mimeType;
        $this->size = $size;
        $this->temporaryFilename = $temporaryFilename;
    }

    /**
     * @return string
     */
    public function getOriginalFilename(): string
    {
        return $this->originalFilename;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getTemporaryFilename(): string
    {
        return $this->temporaryFilename;
    }
}
