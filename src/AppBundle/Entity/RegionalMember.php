<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RegionalMemberRepository")
 * @ORM\Table(name="regional_member")
 */
class RegionalMember
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Regional", inversedBy="member")
     * @ORM\JoinColumn(name="regional_id", referencedColumnName="id")
     */
    protected $regional;

    /**
     * @ORM\ManyToOne(targetEntity="Kabupaten", inversedBy="regional")
     * @ORM\JoinColumn(name="kabupaten_id", referencedColumnName="id")
     */
    protected $kabupaten;

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
     * Set regional
     *
     * @param Regional $regional
     * @return RegionalMember
     */
    public function setRegional(Regional $regional = null)
    {
        $this->regional = $regional;

        return $this;
    }

    /**
     * Get regional
     *
     * @return Regional
     */
    public function getRegional()
    {
        return $this->regional;
    }

    /**
     * Set kabupaten
     *
     * @param Kabupaten $kabupaten
     * @return RegionalMember
     */
    public function setKabupaten(Kabupaten $kabupaten = null)
    {
        $this->kabupaten = $kabupaten;

        return $this;
    }

    /**
     * Get kabupaten
     *
     * @return Kabupaten
     */
    public function getKabupaten()
    {
        return $this->kabupaten;
    }
}
