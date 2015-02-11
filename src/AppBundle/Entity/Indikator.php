<?php

namespace AppBundle\Entity;

use AppBundle\Chart\ChartIndicatorInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="indikator")
 **/
class Indikator implements ChartIndicatorInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Indikator", mappedBy="parent")
     **/
    protected $child;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Indikator", inversedBy="child")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    protected $parent;

    /**
     * @ORM\Column(name="code", type="string", length=4, unique=true)
     **/
    protected $code;

    /**
     * @ORM\Column(name="chart_title", type="string", length=255)
     **/
    protected $chartTitle;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     **/
    protected $name;

    /**
     * @ORM\Column(name="merah", type="smallint")
     **/
    protected $indikatorMerah;

    /**
     * @ORM\Column(name="kuning", type="smallint")
     **/
    protected $indikatorKuning;

    /**
     * @ORM\Column(name="hijau", type="smallint")
     **/
    protected $indikatorHijau;

    public function __construct()
    {
        $this->child = new ArrayCollection();

        $this->indikatorMerah = 0;
        $this->indikatorKuning = 40;
        $this->indikatorHijau = 70;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get credential
     *
     * @return string
     */
    public function getCredential()
    {
        return $this->getCode();
    }

    /**
     * @param string $chartTitle
     * @return $this
     **/
    public function setChartTitle($chartTitle)
    {
        $this->chartTitle = $chartTitle;

        return $this;
    }

    /**
     * @return string
     **/
    public function getChartTitle()
    {
        return $this->chartTitle;
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
     * @return Indikator
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
     * @return Indikator
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set indikatorMerah
     *
     * @param integer $indikatorMerah
     * @return Indikator
     */
    public function setRedIndicator($indikatorMerah)
    {
        $this->indikatorMerah = $indikatorMerah;

        return $this;
    }

    /**
     * Get indikatorMerah
     *
     * @return integer 
     */
    public function getRedIndicator()
    {
        return $this->indikatorMerah;
    }

    /**
     * Set indikatorKuning
     *
     * @param integer $indikatorKuning
     * @return Indikator
     */
    public function setYellowIndicator($indikatorKuning)
    {
        $this->indikatorKuning = $indikatorKuning;

        return $this;
    }

    /**
     * Get indikatorKuning
     *
     * @return integer 
     */
    public function getYellowIndicator()
    {
        return $this->indikatorKuning;
    }

    /**
     * Set indikatorHijau
     *
     * @param integer $indikatorHijau
     * @return Indikator
     */
    public function setGreenIndicator($indikatorHijau)
    {
        $this->indikatorHijau = $indikatorHijau;

        return $this;
    }

    /**
     * Get indikatorHijau
     *
     * @return integer 
     */
    public function getGreenIndicator()
    {
        return $this->indikatorHijau;
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\Indikator $child
     * @return Indikator
     */
    public function addChild(Indikator $child)
    {
        $this->child[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\Indikator $child
     */
    public function removeChild(Indikator $child)
    {
        $this->child->removeElement($child);
    }

    /**
     * Get child
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\Indikator $parent
     * @return Indikator
     */
    public function setParent(Indikator $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Indikator 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set indikatorMerah
     *
     * @param integer $indikatorMerah
     * @return Indikator
     */
    public function setIndikatorMerah($indikatorMerah)
    {
        $this->indikatorMerah = $indikatorMerah;

        return $this;
    }

    /**
     * Get indikatorMerah
     *
     * @return integer 
     */
    public function getIndikatorMerah()
    {
        return $this->indikatorMerah;
    }

    /**
     * Set indikatorKuning
     *
     * @param integer $indikatorKuning
     * @return Indikator
     */
    public function setIndikatorKuning($indikatorKuning)
    {
        $this->indikatorKuning = $indikatorKuning;

        return $this;
    }

    /**
     * Get indikatorKuning
     *
     * @return integer 
     */
    public function getIndikatorKuning()
    {
        return $this->indikatorKuning;
    }

    /**
     * Set indikatorHijau
     *
     * @param integer $indikatorHijau
     * @return Indikator
     */
    public function setIndikatorHijau($indikatorHijau)
    {
        $this->indikatorHijau = $indikatorHijau;

        return $this;
    }

    /**
     * Get indikatorHijau
     *
     * @return integer 
     */
    public function getIndikatorHijau()
    {
        return $this->indikatorHijau;
    }
}
