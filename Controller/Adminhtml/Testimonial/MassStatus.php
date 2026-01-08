<?php
/**
 * Copyright © Ashokkumar. All rights reserved.
 */

declare(strict_types=1);

namespace Ashokkumar\Testimonial\Controller\Adminhtml\Testimonial;

use Ashokkumar\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Mass status controller
 */
class MassStatus extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level
     */
    public const ADMIN_RESOURCE = 'Ashokkumar_Testimonial::save';

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        private readonly Filter $filter,
        private readonly CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $status = (int)$this->getRequest()->getParam('status');
            $collectionSize = $collection->getSize();

            foreach ($collection as $testimonial) {
                $testimonial->setStatus($status);
                $testimonial->save();
            }

            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been updated.', $collectionSize)
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('Something went wrong while updating testimonials.')
            );
        }

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
