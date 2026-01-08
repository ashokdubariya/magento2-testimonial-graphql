<?php
/**
 * Copyright © Ashokkumar. All rights reserved.
 */

declare(strict_types=1);

namespace Ashokkumar\Testimonial\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Testimonial search results interface
 * @api
 */
interface TestimonialSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get testimonials list
     *
     * @return \Ashokkumar\Testimonial\Api\Data\TestimonialInterface[]
     */
    public function getItems();

    /**
     * Set testimonials list
     *
     * @param \Ashokkumar\Testimonial\Api\Data\TestimonialInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
