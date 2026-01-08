<?php
/**
 * Copyright © Ashokkumar. All rights reserved.
 */

declare(strict_types=1);

namespace Ashokkumar\Testimonial\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Testimonial listing controller
 */
class Index implements HttpGetActionInterface
{
    /**
     * @param ResultFactory $resultFactory
     */
    public function __construct(
        private readonly ResultFactory $resultFactory
    ) {
    }

    /**
     * Execute action
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
