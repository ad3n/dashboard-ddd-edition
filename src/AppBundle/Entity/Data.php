<?php

namespace AppBundle\Entity;

use AppBundle\Chart\ChartIndicatorInterface;
use AppBundle\Chart\Data\ChartDataInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="data")
 **/
class Data implements ChartDataInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @ORM\Column(name="code_indikator", type="string", length=4)
     **/
    protected $indikator;

    /**
     * @ORM\Column(name="nominator", type="decimal", scale=0, precision=12)
     **/
    protected $nominator;

    /**
     * @ORM\Column(name="de_nominator", type="decimal", scale=0, precision=12)
     **/
    protected $deNominator;

    /**
     * @ORM\Column(name="value", type="decimal", scale=0, precision=12)
     **/
    protected $value;

    /**
     * @ORM\Column(name="bulan", type="smallint")
     **/
    protected $bulan;

    /**
     * @ORM\Column(name="tahun", type="integer")
     **/
    protected $tahun;

    /**
     * @ORM\Column(name="kelurahan", type="string", length=7, nullable=true)
     **/
    protected $kelurahan;

    /**
     * @ORM\Column(name="kecamatan", type="string", length=6, nullable=true)
     **/
    protected $kecamatan;

    /**
     * @ORM\Column(name="kabupaten", type="string", length=4, nullable=true)
     **/
    protected $kabupaten;

    /**
     * @ORM\Column(name="propinsi", type="string", length=2, nullable=true)
     **/
    protected $propinsi;

    /**
     * @ORM\Column(name="regional", type="string", length=7, nullable=true)
     **/
    protected $regional;

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
     * @param ChartIndicatorInterface $indikator
     * @return $this
     */
    public function setIndicator(ChartIndicatorInterface $indikator)
    {
        $this->indikator = $indikator->getCredential();

        return $this;
    }

    /**
     * @return string
     */
    public function getIndicator()
    {
        return $this->indikator;
    }

    /**
     * Set nominator
     *
     * @param string $nominator
     * @return Data
     */
    public function setNominator($nominator)
    {
        $this->nominator = $nominator;

        return $this;
    }

    /**
     * Get nominator
     *
     * @return string
     */
    public function getNominator()
    {
        return $this->nominator;
    }

    /**
     * Set deNominator
     *
     * @param string $deNominator
     * @return Data
     */
    public function setDenominator($deNominator)
    {
        $this->deNominator = $deNominator;

        return $this;
    }

    /**
     * Get deNominator
     *
     * @return string
     */
    public function getDenominator()
    {
        return $this->deNominator;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Data
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set bulan
     *
     * @param integer $bulan
     * @return Data
     */
    public function setMonth($bulan)
    {
        $this->bulan = $bulan;

        return $this;
    }

    /**
     * Get bulan
     *
     * @return integer
     */
    public function getMonth()
    {
        return $this->bulan;
    }

    /**
     * Set tahun
     *
     * @param integer $tahun
     * @return Data
     */
    public function setYear($tahun)
    {
        $this->tahun = $tahun;

        return $this;
    }

    /**
     * Get tahun
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->tahun;
    }

    /**
     * Set kelurahan
     *
     * @param string $kelurahan
     * @return Data
     */
    public function setKelurahan($kelurahan)
    {
        $this->kelurahan = $kelurahan;

        return $this;
    }

    /**
     * Get kelurahan
     *
     * @return string
     */
    public function getKelurahan()
    {
        return $this->kelurahan;
    }

    /**
     * Set kecamatan
     *
     * @param string $kecamatan
     * @return Data
     */
    public function setKecamatan($kecamatan)
    {
        $this->kecamatan = $kecamatan;

        return $this;
    }

    /**
     * Get kecamatan
     *
     * @return string
     */
    public function getKecamatan()
    {
        return $this->kecamatan;
    }

    /**
     * Set kabupaten
     *
     * @param string $kabupaten
     * @return Data
     */
    public function setKabupaten($kabupaten)
    {
        $this->kabupaten = $kabupaten;

        return $this;
    }

    /**
     * Get kabupaten
     *
     * @return string
     */
    public function getKabupaten()
    {
        return $this->kabupaten;
    }

    /**
     * Set propinsi
     *
     * @param string $propinsi
     * @return Data
     */
    public function setPropinsi($propinsi)
    {
        $this->propinsi = $propinsi;

        return $this;
    }

    /**
     * Get propinsi
     *
     * @return string
     */
    public function getPropinsi()
    {
        return $this->propinsi;
    }

    /**
     * Set regional
     *
     * @param string $regional
     * @return Data
     */
    public function setRegional($regional)
    {
        $this->regional = $regional;

        return $this;
    }

    /**
     * Get regional
     *
     * @return string 
     */
    public function getRegional()
    {
        return $this->regional;
    }

    /**
     * Set indikator
     *
     * @param string $indikator
     * @return Data
     */
    public function setIndikator($indikator)
    {
        $this->indikator = $indikator;

        return $this;
    }

    /**
     * Get indikator
     *
     * @return string 
     */
    public function getIndikator()
    {
        return $this->indikator;
    }
}
