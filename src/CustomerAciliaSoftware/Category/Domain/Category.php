<?php


namespace App\CustomerAciliaSoftware\Category\Domain;


use DateTime;
use LogicException;
use Symfony\Component\Uid\Uuid;

class Category
{
    private string $id;
    private string $name;
    private string $description;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    /**
     * Category constructor.
     * @param string $id
     * @param string $name
     * @param string $description
     */
    public function __construct(string $name, string $description)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->setName($name);
        $this->setDescription($description);
        $this->createdAt = new DateTime();
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    private function setName(string $name): void
    {
        if (strlen($name) < 1) {
            throw new LogicException('A name is required!');
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    private function setDescription(string $description): void
    {
        if (strlen($description) < 1) {
            throw new LogicException('A description is required!');
        }

        $this->description = $description;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function markAsUpdated(): void
    {
        $this->updatedAt = new DateTime();
    }





}
