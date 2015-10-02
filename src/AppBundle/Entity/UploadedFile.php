<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JsonSerializable;

/**
* @ORM\MappedSuperclass
 */
class UploadedFile implements JsonSerializable
{
    /**
    * @ORM\Column(type="string", length=255)
    */
    protected $path;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    protected $name;

    /**
     * @return string|null
     */
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    /**
     * @return string|null
     */
    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    /**
     * @return string
     */
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web'.$this->getUploadDir();
    }

    /**
     * @return string
     */
    protected function getUploadDir()
    {
        return '/uploads';
    }

    /**
     * Set path
     *
     * @param string $path
     * @return UploadedFile
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return UploadedFile
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get size of the file in octets if it exists
     *
     * @return int|null
     */
    public function getSize()
    {
        return file_exists($this->getAbsolutePath()) ? filesize($this->getAbsolutePath()) : null;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array(
            'name' => $this->name,
            'webPath' => $this->getWebPath(),
            'size' => $this->getSize()
        );
    }
}
