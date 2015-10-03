<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Aggregate
 *
 * @ORM\Entity
 * @ORM\Table(name="cheerup_aggregate")
 */
class Aggregate
{
    const GROUP    = 'GROUP';
    const OFFSHOOT = 'OFFSHOOT';

    private static $aggregateTypes = [
        self::GROUP    => 'user.aggregate_type.group',
        self::OFFSHOOT => 'user.aggregate_type.offshoot'
    ];

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="Picture",  cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id", nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Choice(callback = "getAggregateTypes")
     */
    private $aggregateType;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Aggregate
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Aggregate
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getAggregateType()
    {
        return $this->aggregateType;
    }

    /**
     * @param string $aggregateType
     */
    public function setAggregateType($aggregateType)
    {
        $this->aggregateType = $aggregateType;
    }

    /**
     * @return array
     */
    public static function getProfileTypes()
    {
        return array_keys(self::$aggregateTypes);
    }

    /**
     * @return array
     */
    public static function getProfileTypesChoices()
    {
        return self::$aggregateTypes;
    }
}
