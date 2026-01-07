<?php
/**
 * Copyright © Ashok. All rights reserved.
 */

declare(strict_types=1);

namespace Ashok\Testimonial\Controller\Adminhtml\Testimonial;

use Ashok\Testimonial\Api\Data\TestimonialInterfaceFactory;
use Ashok\Testimonial\Api\TestimonialRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Save controller
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level
     */
    public const ADMIN_RESOURCE = 'Ashok_Testimonial::save';

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param TestimonialInterfaceFactory $testimonialFactory
     * @param TestimonialRepositoryInterface $testimonialRepository
     */
    public function __construct(
        Context $context,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly TestimonialInterfaceFactory $testimonialFactory,
        private readonly TestimonialRepositoryInterface $testimonialRepository
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
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            return $resultRedirect->setPath('*/*/');
        }

        $id = (int)($this->getRequest()->getParam('testimonial_id') ?? 0);

        try {
            if ($id) {
                $testimonial = $this->testimonialRepository->getById($id);
            } else {
                $testimonial = $this->testimonialFactory->create();
            }

            $testimonial->setCustomerName((string)$data['customer_name']);
            $testimonial->setCustomerEmail((string)$data['customer_email']);
            $testimonial->setMessage((string)$data['message']);
            $testimonial->setRating((int)$data['rating']);
            $testimonial->setStatus((int)$data['status']);

            $this->testimonialRepository->save($testimonial);
            $this->messageManager->addSuccessMessage(__('You saved the testimonial.'));
            $this->dataPersistor->clear('ashok_testimonial');

            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', [
                    'testimonial_id' => $testimonial->getTestimonialId(),
                    '_current' => true
                ]);
            }

            return $resultRedirect->setPath('*/*/');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('Something went wrong while saving the testimonial.')
            );
        }

        $this->dataPersistor->set('ashok_testimonial', $data);
        return $resultRedirect->setPath('*/*/edit', [
            'testimonial_id' => $id
        ]);
    }
}
