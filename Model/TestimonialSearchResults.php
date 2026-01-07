<?php
/**
 * Copyright © Ashok. All rights reserved.
 */

declare(strict_types=1);

namespace Ashok\Testimonial\Model;

use Ashok\Testimonial\Api\Data\TestimonialSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Testimonial search results implementation
 */
class TestimonialSearchResults extends SearchResults implements TestimonialSearchResultsInterface
{
}
