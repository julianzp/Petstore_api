<?php

namespace App\Entity;

use App\Repository\PetRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PetRepository::class)
 */
class Pet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="array")
     */
    private $photoUrl = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @var Collection|Category[]
     *
     * @ORM\OneToOne(targetEntity="Category")
     */
    private $category;


    /**
     * @var Collection|Tags[]
     *
     * @ORM\ManyToOne(targetEntity="Tags")
     */
    private $tags;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getPhotoUrl(): array
    {
        return $this->photoUrl;
    }

    /**
     * @param array $photoUrl
     */
    public function setPhotoUrl(array $photoUrl): void
    {
        $this->photoUrl = $photoUrl;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return Category[]|Collection
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category[]|Collection $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return Tags[]|Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tags[]|Collection $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }






}
