<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fruit
 *
 * @ORM\Table(name="fruit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FruitRepository")
 */
class Fruit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="origin", type="string", length=255)
     */
    private $origin;

    /**
     * @var bool
     *
     * @ORM\Column(name="comestible", type="boolean")
     */
    private $comestible;


    /**
     * Get id
     *
     * @return int
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
     * @return Fruit
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
     * Set origin
     *
     * @param string $origin
     *
     * @return Fruit
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set comestible
     *
     * @param boolean $comestible
     *
     * @return Fruit
     */
    public function setComestible($comestible)
    {
        $this->comestible = $comestible;

        return $this;
    }

    /**
     * Get comestible
     *
     * @return bool
     */
    public function getComestible()
    {
        return $this->comestible;
    }
}
