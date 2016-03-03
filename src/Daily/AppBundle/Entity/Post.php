<?php

namespace Daily\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Daily\AppBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="Proszę wprowadzić tytuł postu")
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     * @ORM\Column(name="createdBy", type="datetime")
     */
    private $createdBy;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="imageFile", type="object")
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="imagename", type="string", length=255)
     */
    private $imagename;

    /**
     * @var string
     *
     * @ORM\Column(name="isAccepted", type="string", length=255)
     */
    private $isAccepted;
    
    /**
     * @ORM\ManyToOne(targetEntity="Daily\AppBundle\Entity\User", inversedBy="posts")
     * 
     */
    private $user;
    
    /*
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="post")
     */
    
    private $rating;
    
    /*
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="posts")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * @Assert\NotBlank(message="Proszę wprowadzić kategorię")
     */
    private $category;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    private $comment;
       
    /**
     * @var string
     * @ORM\Column(name="description")
     * @Assert\NotBlank(message="Proszę wprowadzić opis")
     */
    private $description;
    
    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;
 
    
    public function __construct() 
    {
        $this->createdAt = new \DateTime('now');
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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set rating
     *
     * @param string $rating
     * @return Post
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\Comment $comment
     * @return Post
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Post
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
     * Set createdBy
     *
     * @param \DateTime $createdBy
     * @return Post
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
     * Set imageFile
     *
     * @param \stdClass $imageFile
     * @return Post
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * Get imageFile
     *
     * @return \stdClass 
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set imagename
     *
     * @param string $imagename
     * @return Post
     */
    public function setImagename($imagename)
    {
        $this->imagename = $imagename;

        return $this;
    }

    /**
     * Get imagename
     *
     * @return string 
     */
    public function getImagename()
    {
        return $this->imagename;
    }

    /**
     * Set isAccepted
     *
     * @param string $isAccepted
     * @return Post
     */
    public function setIsAccepted($isAccepted)
    {
        $this->isAccepted = $isAccepted;

        return $this;
    }

    /**
     * Get isAccepted
     *
     * @return string 
     */
    public function getIsAccepted()
    {
        return $this->isAccepted;
    }
    /**
     * Set user
     *
     * @param string $user
     * @return User
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Set category
     *
     * @param string $category
     * @return Category
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Set description
     *
     * @param string $description
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
     public function getSlug()
    {
        return $this->slug;
    }
    
    

    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
