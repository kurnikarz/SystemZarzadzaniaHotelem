<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFrom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateTo;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="reservation", cascade={"remove"})
     */
    private $rooms;

    /**
     * @ORM\OneToOne(targetEntity=HotelGuest::class, mappedBy="reservation", cascade={"persist", "remove"})
     */
    private $hotelGuest;

    /**
     * @ORM\ManyToMany(targetEntity=AddidtionalResources::class, mappedBy="reservation")
     */
    private $addidtionalResources;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accepted;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->addidtionalResources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function setDateFrom(\DateTimeInterface $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    public function setDateTo(\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setReservation($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getReservation() === $this) {
                $room->setReservation(null);
            }
        }

        return $this;
    }

    public function getHotelGuest(): ?HotelGuest
    {
        return $this->hotelGuest;
    }

    public function setHotelGuest(?HotelGuest $hotelGuest): self
    {
        // unset the owning side of the relation if necessary
        if ($hotelGuest === null && $this->hotelGuest !== null) {
            $this->hotelGuest->setReservation(null);
        }

        // set the owning side of the relation if necessary
        if ($hotelGuest !== null && $hotelGuest->getReservation() !== $this) {
            $hotelGuest->setReservation($this);
        }

        $this->hotelGuest = $hotelGuest;

        return $this;
    }

    /**
     * @return Collection|AddidtionalResources[]
     */
    public function getAddidtionalResources(): Collection
    {
        return $this->addidtionalResources;
    }

    public function addAddidtionalResource(AddidtionalResources $addidtionalResource): self
    {
        if (!$this->addidtionalResources->contains($addidtionalResource)) {
            $this->addidtionalResources[] = $addidtionalResource;
            $addidtionalResource->addReservation($this);
        }

        return $this;
    }

    public function removeAddidtionalResource(AddidtionalResources $addidtionalResource): self
    {
        if ($this->addidtionalResources->removeElement($addidtionalResource)) {
            $addidtionalResource->removeReservation($this);
        }

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
