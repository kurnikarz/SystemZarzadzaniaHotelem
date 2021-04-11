<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
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
     * @ORM\ManyToOne(targetEntity=Reception::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reception;

    /**
     * @ORM\OneToOne(targetEntity=Bill::class, mappedBy="reservation", cascade={"persist", "remove"})
     */
    private $bill;

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

    public function getReception(): ?Reception
    {
        return $this->reception;
    }

    public function setReception(?Reception $reception): self
    {
        $this->reception = $reception;

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
}
