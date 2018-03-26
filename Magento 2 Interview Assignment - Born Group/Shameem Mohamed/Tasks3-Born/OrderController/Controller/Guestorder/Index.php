<?php
namespace Born\OrderController\Controller\Guestorder;

class Index extends \Magento\Framework\App\Action\Action
{
	/**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;
	
	/**
     * @var \Born\OrderController\Helper\OrderData
     */
	protected $_orderHelper;
	
    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
   	 * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory 
	 * @param \Born\OrderController\Helper\OrderData $orderHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
       	\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
		\Born\OrderController\Helper\OrderData $orderHelper
		
    ) {
       	$this->resultJsonFactory = $resultJsonFactory;
		$this->_orderHelper = $orderHelper;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
		$orderid = $this->getRequest()->getParam('id');
		$orderData = ['response'=>null];
		if ($orderid) {
			$orderData['response'] = $this->_orderHelper->getOrderInfo($orderid);
		} else {
			$orderData['response'] = array('error' => 'The order does not exist or was not provided');
		}
			
		return $result->setData($orderData);
    }
}
