<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BillRepository::class)
 */
class Bill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=HotelGuest::class, inversedBy="bill", cascade={"persist", "remove"})
     */
    private $hotelGuest;

    /**
     * @ORM\ManyToOne(targetEntity=AddidtionalResources::class, inversedBy="bills")
     */
    private $addidtionalResources;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="bills")
     */
    private $room;

    /**
     * @ORM\OneToOne(targetEntity=Reservation::class, inversedBy="bill", cascade={"persist", "remove"})
     */
    private $reservation;

    /**
     * @ORM\Column(type="float")
     */
    private $sum;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotelGuest(): ?HotelGuest
    {
        return $this->hotelGuest;
    }

    public function setHotelGuest(?HotelGuest $hotelGuest): self
    {
        $this->hotelGuest = $hotelGuest;

        return $this;
    }

    public function getAddidtionalResources(): ?AddidtionalResources
    {
        return $this->addidtionalResources;
    }

    public function setAddidtionalResources(?AddidtionalResources $addidtionalResources): self
    {
        $this->addidtionalResources = $addidtionalResources;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getSum(): ?float
    {
        return $this->sum;
    }

    public function setSum(float $sum): self
    {
        $this->sum = $sum;

        return $this;
    }
}
