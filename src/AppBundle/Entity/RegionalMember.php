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
    protected $regional;
    protected $kabupaten;
}
