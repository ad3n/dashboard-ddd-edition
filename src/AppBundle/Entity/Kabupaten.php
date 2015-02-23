<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\KabupatenRepository")
 * @ORM\Table(name="kabupaten")
 */
class Kabupaten
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
     * @ORM\ManyToOne(targetEntity="Propinsi", inversedBy="kabupaten")
     * @ORM\JoinColumn(name="propinsi_id", referencedColumnName="id")
     */
    protected $propinsi;

    /**
     * @ORM\OneToMany(targetEntity="RegionalMember", mappedBy="kabupaten")
     */
    protected $regional;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->regional = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set propinsi
     *
     * @param Propinsi $propinsi
     * @return $this
     */
    public function setPropinsi(Propinsi $propinsi = null)
    {
        $this->propinsi = $propinsi;

        return $this;
    }

    /**
     * Get propinsi
     *
     * @return Propinsi
     */
    public function getPropinsi()
    {
        return $this->propinsi;
    }

    /**
     * Add regional
     *
     * @param RegionalMember $regional
     * @return $this
     */
    public function addRegional(RegionalMember $regional)
    {
        $this->regional[] = $regional;

        return $this;
    }

    /**
     * Remove regional
     *
     * @param RegionalMember $regional
     */
    public function removeRegional(RegionalMember $regional)
    {
        $this->regional->removeElement($regional);
    }

    /**
     * Get regional
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegional()
    {
        return $this->regional;
    }
}
