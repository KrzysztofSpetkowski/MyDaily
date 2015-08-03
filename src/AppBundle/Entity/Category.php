<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category
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
     * @ORM\Column(name="sport", type="string", length=255)
     */
    private $sport;

    /**
     * @var string
     *
     * @ORM\Column(name="nutrition", type="string", length=255)
     */
    private $nutrition;

    /**
     * @var string
     *
     * @ORM\Column(name="advice", type="string", length=255)
     */
    private $advice;

    /**
     * @var string
     *
     * @ORM\Column(name="commentId", type="string", length=255)
     */
    private $commentId;


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
     * Set sport
     *
     * @param string $sport
     * @return Category
     */
    public function setSport($sport)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return string 
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set nutrition
     *
     * @param string $nutrition
     * @return Category
     */
    public function setNutrition($nutrition)
    {
        $this->nutrition = $nutrition;

        return $this;
    }

    /**
     * Get nutrition
     *
     * @return string 
     */
    public function getNutrition()
    {
        return $this->nutrition;
    }

    /**
     * Set advice
     *
     * @param string $advice
     * @return Category
     */
    public function setAdvice($advice)
    {
        $this->advice = $advice;

        return $this;
    }

    /**
     * Get advice
     *
     * @return string 
     */
    public function getAdvice()
    {
        return $this->advice;
    }

    /**
     * Set commentId
     *
     * @param string $commentId
     * @return Category
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;

        return $this;
    }

    /**
     * Get commentId
     *
     * @return string 
     */
    public function getCommentId()
    {
        return $this->commentId;
    }
}
