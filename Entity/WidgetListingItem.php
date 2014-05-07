<?php

namespace Victoire\ListingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Bundle\CoreBundle\Annotations as VIC;
use Victoire\Bundle\CoreBundle\Entity\Widget;

/**
 * WidgetListingItem
 *
 * @ORM\Table("cms_widget_listing_item")
 * @ORM\Entity
 */
class WidgetListingItem extends Widget
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="WidgetListing", inversedBy="items")
     * @ORM\JoinColumn(name="listing_id", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    protected $listing;

    /**
     * @ORM\Column(name="position", type="integer")
     */
    protected $position = 0;

    /**
     * if __isset returns true, returns linked entity value
     * else, call default get() method
     *
     * @param string $name magic called value
     * @return liked entity value
     **/
    public function __get($name)
    {
        if ($this->getEntity()) {
            return $this->getEntity()->getReferedValue($this->getListing()->getBusinessEntityName(), $name);
        }
    }

    /**
     * check if asked field is defined in the entity
     * and if entity is in proxy mode
     *
     * @param string $name magic called value
     * @return liked entity value
     **/
    public function __isset($name)
    {
        if (array_key_exists($name, get_class_vars(get_class($this)))) {
            if ($this->getListing() && $this->getListing()->getBusinessEntityName()) {
                return true;
            }
        }

        return false;
    }
    /**
     * Get fields
     *
     * @return string
     */
    public function getFields()
    {
        return $this->getListing()->getFields();
    }

    /**
     * Set title
     *
     * @param string $title
     * @return WidgetListingItem
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
     * Set description
     *
     * @param string $description
     * @return WidgetListingItem
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
    /**
     * Set listing
     *
     * @param string $listing
     * @return WidgetListingItem
     */
    public function setListing($listing)
    {
        $this->listing = $listing;

        return $this;
    }

    /**
     * Get listing
     *
     * @return string
     */
    public function getListing()
    {
        return $this->listing;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set position
     *
     * @param integer The position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
