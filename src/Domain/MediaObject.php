<?php
declare(strict_types=1);

namespace App\Domain;

use Symfony\Component\HttpFoundation\File\File;

class MediaObject
{
    private int $id;

    public string $contentUrl;

    public  $file;

    public string $filePath;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContentUrl(): string
    {
        return $this->contentUrl;
    }


    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @param string $contentUrl
     */
    public function setContentUrl(string $contentUrl): void
    {
        $this->contentUrl = $contentUrl;
    }

    /**
     * @param string $filePath
     */
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }
}
