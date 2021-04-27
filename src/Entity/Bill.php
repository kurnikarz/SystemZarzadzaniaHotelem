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
     * @ORM\OneToOne(targetEntity=Reservation::class, inversedBy="bill", cascade={"persist", "remove"})
     */
    private $reservation;

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


    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }
}
