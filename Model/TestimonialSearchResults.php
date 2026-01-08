<?php
/**
 * Copyright © Ashokkumar. All rights reserved.
 */

declare(strict_types=1);

namespace Ashokkumar\Testimonial\Model;

use Ashokkumar\Testimonial\Api\Data\TestimonialSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Testimonial search results implementation
 */
class TestimonialSearchResults extends SearchResults implements TestimonialSearchResultsInterface
{
}
