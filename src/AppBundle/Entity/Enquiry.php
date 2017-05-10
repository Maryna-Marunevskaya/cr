<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="enquiry")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EnquiryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Enquiry
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     /**
    * @ORM\Column(name="enquiry", type="string", nullable=false)
    **/
    protected $enquiry;
    /**
     * @ORM\ManyToMany(targetEntity="Category")
     * @ORM\JoinTable(name="enquiry_category",
     *     joinColumns={@ORM\JoinColumn(name="enquiry_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)}
     * )
     */
    protected $categories;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set enquiry
     *
     * @param string $enquiry
     *
     * @return Enquiry
     */
    public function setEnquiry($enquiry)
    {
        $this->enquiry = $enquiry;

        return $this;
    }

    /**
     * Get enquiry
     *
     * @return string
     */
    public function getEnquiry()
    {
        return $this->enquiry;
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Enquiry
     */
    public function addCategory(\AppBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Category $category
     */
    public function removeCategory(\AppBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
