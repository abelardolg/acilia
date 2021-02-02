<?php

namespace App\CivitatisSoftware\Actividad\Dominio;

use DatePeriod;
use DateTimeImmutable;
use InvalidArgumentException;
use Symfony\Component\Uid\Uuid;

final class Actividad
{
    const MAX_TITLE_LENGTH = 64;
    const MAX_POPULARITY = 10;

    private string $id;
    protected string $title;
    protected string $description;
    protected DatePeriod $availabilityDateRange;
    protected float $pricePerPax;
    protected int $popularity;
    protected DateTimeImmutable  $createdAt;
    protected DateTimeImmutable  $updatedAt;

    public function __construct(string $title, string $description, DatePeriod $availabilityDateRange, float $pricePerPax, int $popularity)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->setTitle($title);
        $this->description = $description;
        $this->setAvailabilityDateRange($availabilityDateRange);
        $this->setPricePerPax(floatval($pricePerPax));
        $this->setPopularity($popularity);
        $this->createdAt = new DateTimeImmutable();
        $this->markAsUpdated();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        if (strlen($title) > self::MAX_TITLE_LENGTH) {
            throw new InvalidArgumentException(sprintf("La longitud del título de esta actividad no debe exceder de %d caracteres", self::MAX_TITLE_LENGTH));
        }
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return DatePeriod
     */
    public function getAvailabilityDateRange(): DatePeriod
    {
        return $this->availabilityDateRange;
    }

    /**
     * @param DatePeriod $availabilityDateRange
     */
    private function setAvailabilityDateRange(DatePeriod $availabilityDateRange): void
    {
        $hoy = new DateTimeImmutable();
        if ($availabilityDateRange->getStartDate() < $hoy) {
            throw new InvalidArgumentException("La fecha de comienzo de la actividad no puede ser anterior a hoy");
        }
        $this->availabilityDateRange = $availabilityDateRange;
    }

    /**
     * @return float
     */
    public function getPricePerPax(): float
    {
        return $this->pricePerPax;
    }

    /**
     * @param float $pricePerPax
     */
    private function setPricePerPax(float $pricePerPax): void
    {
        if (!filter_var($pricePerPax, FILTER_VALIDATE_FLOAT))
        {
            throw new InvalidArgumentException("El precio de la actividad debe estar reflejado con valores decimales (Ej. 34.0 €)");
        }
        if ($pricePerPax < 0)
        {
            throw new InvalidArgumentException("El precio de la actividad no puede ser negativo");
        }

        $this->pricePerPax = $pricePerPax;
    }

    /**
     * @return int
     */
    public function getPopularity(): int
    {
        return $this->popularity;
    }

    /**
     * @param int $popularity
     */
    private function setPopularity(int $popularity): void
    {
        if ($popularity > self::MAX_POPULARITY) {
            throw new InvalidArgumentException(sprintf("La popularidad de la actividad no debe exceder de %d puntos", self::MAX_POPULARITY));
        }
        $this->popularity = $popularity;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

}
