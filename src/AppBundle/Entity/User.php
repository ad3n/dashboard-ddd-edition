<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 **/
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @ORM\Column(name="full_name", type="string", length=77, nullable=true)
     **/
    protected $fullName;

    /**
     * @ORM\Column(name="authentication_token", type="string", length=40, nullable=true)
     **/
    protected $authenticationToken;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Block", mappedBy="user")
     **/
    protected $block;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFullName($fullName)
    {
        $this->fullName = strtoupper($fullName);

        return $this;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setAuthenticationToken($authenticationToken)
    {
        $this->authenticationToken = $authenticationToken;

        return $this;
    }

    public function getAuthenticationToken()
    {
        return $this->authenticationToken;
    }

    /**
     * Add block
     *
     * @param Block $block
     * @return User
     */
    public function addBlock(Block $block)
    {
        $this->block[] = $block;

        return $this;
    }

    /**
     * Remove block
     *
     * @param Block $block
     */
    public function removeBlock(Block $block)
    {
        $this->block->removeElement($block);
    }

    /**
     * Get block
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlock()
    {
        return $this->block;
    }
}
