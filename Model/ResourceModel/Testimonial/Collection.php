<?php
/**
 * Copyright © Ashok. All rights reserved.
 */

declare(strict_types=1);

namespace Ashok\Testimonial\Model\ResourceModel\Testimonial;

use Ashok\Testimonial\Model\Testimonial;
use Ashok\Testimonial\Model\ResourceModel\Testimonial as TestimonialResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Testimonial collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'testimonial_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'ashok_testimonial_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'testimonial_collection';

    /**
     * Initialize collection model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(Testimonial::class, TestimonialResource::class);
    }
}
