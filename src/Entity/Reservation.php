<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToOne(targetEntity=Bill::class, mappedBy="reservation", cascade={"persist", "remove"})
     */
    private $bill;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="reservation")
     */
    private $rooms;

    /**
     * @ORM\OneToMany(targetEntity=AddidtionalResources::class, mappedBy="reservation")
     */
    private $addidtionalResources;

    /**
     * @ORM\OneToOne(targetEntity=HotelGuest::class, mappedBy="reservation", cascade={"persist", "remove"})
     */
    private $hotelGuest;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->addidtionalResources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBill(): ?Bill
    {
        return $this->bill;
    }

    public function setBill(?Bill $bill): self
    {
        // unset the owning side of the relation if necessary
        if ($bill === null && $this->bill !== null) {
            $this->bill->setReservation(null);
        }

        // set the owning side of the relation if necessary
        if ($bill !== null && $bill->getReservation() !== $this) {
            $bill->setReservation($this);
        }

        $this->bill = $bill;

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
            $addidtionalResource->setReservation($this);
        }

        return $this;
    }

    public function removeAddidtionalResource(AddidtionalResources $addidtionalResource): self
    {
        if ($this->addidtionalResources->removeElement($addidtionalResource)) {
            // set the owning side to null (unless already changed)
            if ($addidtionalResource->getReservation() === $this) {
                $addidtionalResource->setReservation(null);
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
}
