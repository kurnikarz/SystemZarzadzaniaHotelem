<?php

namespace App\Entity;

use App\Repository\ManagerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ManagerRepository::class)
 */
class Manager
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $surname;

    /**
     * @ORM\OneToMany(targetEntity=AddidtionalResources::class, mappedBy="manager")
     */
    private $AdditionalResources;

    public function __construct()
    {
        $this->AdditionalResources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection|AddidtionalResources[]
     */
    public function getAdditionalResources(): Collection
    {
        return $this->AdditionalResources;
    }

    public function addAdditionalResource(AddidtionalResources $additionalResource): self
    {
        if (!$this->AdditionalResources->contains($additionalResource)) {
            $this->AdditionalResources[] = $additionalResource;
            $additionalResource->setManager($this);
        }

        return $this;
    }

    public function removeAdditionalResource(AddidtionalResources $additionalResource): self
    {
        if ($this->AdditionalResources->removeElement($additionalResource)) {
            // set the owning side to null (unless already changed)
            if ($additionalResource->getManager() === $this) {
                $additionalResource->setManager(null);
            }
        }

        return $this;
    }
}
