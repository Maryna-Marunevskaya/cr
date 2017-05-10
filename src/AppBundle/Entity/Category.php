<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Category
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
    * @ORM\Column(name="category", type="string", unique=true, nullable=false)
    **/
    protected $category;
    /**
 * @ORM\ManyToMany(targetEntity="Enquiry", mappedBy="categories")
 */
protected $enquiries;
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
     * Set category
     *
     * @param string $category
     *
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
     * Constructor
     */
    public function __construct()
    {
        $this->enquiries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add enquiry
     *
     * @param \AppBundle\Entity\Enquiry $enquiry
     *
     * @return Category
     */
    public function addEnquiry(\AppBundle\Entity\Enquiry $enquiry)
    {
        $this->enquiries[] = $enquiry;

        return $this;
    }

    /**
     * Remove enquiry
     *
     * @param \AppBundle\Entity\Enquiry $enquiry
     */
    public function removeEnquiry(\AppBundle\Entity\Enquiry $enquiry)
    {
        $this->enquiries->removeElement($enquiry);
    }

    /**
     * Get enquiries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnquiries()
    {
        return $this->enquiries;
    }
}
