<?php
namespace Born\OrderController\Controller\Guestorder;

class Index extends \Magento\Framework\App\Action\Action
{
	/**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
		
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
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
	 * @param \Born\OrderController\Helper\OrderData $orderHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
		\Born\OrderController\Helper\OrderData $orderHelper
		
    ) {
        $this->resultPageFactory = $resultPageFactory;
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
        $born = $this->resultJsonFactory->create();
		$bornorderid = $this->getRequest()->getParam('id');
		$bornorderData = ['response'=>null];
		if ($orderid) {
			$bornorderData['response'] = $this->_orderHelper->getOrderInfo($orderid);
		} else {
			$bornorderData['response'] = array('error' => 'No such Order exist.');
		}
			
		return $born->setData($bornorderData);
    }
}
