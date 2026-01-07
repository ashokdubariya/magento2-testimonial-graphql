<?php
/**
 * Copyright © Ashok. All rights reserved.
 */

declare(strict_types=1);

namespace Ashok\Testimonial\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Testimonial resource model
 */
class Testimonial extends AbstractDb
{
    /**
     * Table name
     */
    private const TABLE_NAME = 'ashok_testimonial';

    /**
     * Primary key field name
     */
    private const ID_FIELD_NAME = 'testimonial_id';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::TABLE_NAME, self::ID_FIELD_NAME);
    }
}
