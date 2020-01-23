<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttachmentRepository")
 * @Vich\Uploadable()
 */
class Attachment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;


    /**
     * @Vich\UploadableField(mapping="post_attachments", fileNameProperty="image")
     */
    private $imageFile;

     /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="AboutPost", inversedBy="attachments")
     */
    private $post;

    public function __construct()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPost(): ?AboutPost
    {
        return $this->post;
    }

    public function setPost(?AboutPost $post): self
    {
        $this->post = $post;

        return $this;
    }

    

    /**
     * @return mixed
     */ 
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @return mixed $imageFile
     */ 
    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;

        if($imageFile) {
            $this->updatedAt = new \DateTime();
        }
    }
}
