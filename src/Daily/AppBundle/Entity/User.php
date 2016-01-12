<?php

namespace Daily\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @ORM\Column(type="string", length=255)
     *
     */
    
    protected $firstName;
    
    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="userEmail", type="string", length=255)
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="userPassword", type="string", length=255)
     */
    private $userPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdBy", type="datetime")
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="ratings", type="string", length=255)
     */
    private $ratings;

    /**
     * @var string
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="users")
     * @var ArrayCollection
     * @ORM\Column(name="comments", type="text")
     */
    private $comments;
    
    /*
     * @ORM\OneToMany(targetEntity="Post", mappedBy="users")
     */
    private $post;
    

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
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    
    /**
     * Get firstName
     *
     * @return string 
     */
    
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
    
    /**
     * Get lastName
     *
     * @return string 
     */
    
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     * @return User
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string 
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string 
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set createdBy
     *
     * @param \DateTime $createdBy
     * @return User
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \DateTime 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set ratings
     *
     * @param string $ratings
     * @return User
     */
    public function setRatings($ratings)
    {
        $this->ratings = $ratings;

        return $this;
    }

    /**
     * Get ratings
     *
     * @return string 
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return User
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }
     /**
     * Set Post
     *
     * @param string $post
     * @return Post
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return string 
     */
    public function getPost()
    {
        return $this->post;
    }
}
