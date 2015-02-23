<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PropinsiRepository")
 * @ORM\Table(name="propinsi")
 */
class Propinsi
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="code", type="string", length=2, unique=true)
     */
    protected $code;

    /**
     * @ORM\Column(name="name", type="string", length=77)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Kabupaten", mappedBy="propinsi")
     */
    protected $kabupaten;

    public function __construct()
    {
        $this->kabupaten = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set code
     *
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
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
     * Add kabupaten
     *
     * @param Kabupaten $kabupaten
     * @return $this
     */
    public function addKabupaten(Kabupaten $kabupaten)
    {
        $this->kabupaten[] = $kabupaten;

        return $this;
    }

    /**
     * Remove kabupaten
     *
     * @param Kabupaten $kabupaten
     */
    public function removeKabupaten(Kabupaten $kabupaten)
    {
        $this->kabupaten->removeElement($kabupaten);
    }

    /**
     * Get kabupaten
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKabupaten()
    {
        return $this->kabupaten;
    }
}
