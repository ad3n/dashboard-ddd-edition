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
}
