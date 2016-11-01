<?php
namespace Kartenmacherei\RestFramework\Request\UploadedFile;

class UploadedFilesCollection
{
    /**
     * @var UploadedFile[]
     */
    private $files;

    /**
     * @param array $files
     */
    public function __construct(array $files)
    {
        $this->files = $files;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasFile(string $name): bool
    {
        return array_key_exists($name, $this->files);
    }

    /**
     * @param string $name
     * @return UploadedFile
     * @throws UploadedFilesException
     */
    public function getFile(string $name): UploadedFile
    {
        if (!$this->hasFile($name)) {
            throw new UploadedFilesException(sprintf('Uploaded file %s not found', $name));
        }
        return $this->files[$name];
    }

    /**
     * @return UploadedFilesCollection
     */
    public static function fromSuperGlobals(): UploadedFilesCollection
    {
        $files = [];
        foreach ($_FILES as $name => $data) {
            $files[$name] = new UploadedFile(
                $data['name'],
                $data['type'],
                $data['size'],
                $data['tmp_name']
            );
        }
        return new self($files);
    }
}
