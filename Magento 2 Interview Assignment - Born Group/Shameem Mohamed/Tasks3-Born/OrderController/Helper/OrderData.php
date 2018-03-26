<?php
namespace Born\OrderController\Helper;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class OrderData extends \Magento\Framework\App\Helper\AbstractHelper 
{

    protected $_orderRepositoryInterface;
    protected $_searchCriteriaBuilder;

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
    	\Magento\Sales\Api\OrderRepositoryInterface $orderRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\App\Helper\Context $context
    ) 
    {
        $this->_orderRepositoryInterface = $orderRepositoryInterface;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
    }
    /**
	Get the Order Information with OrderID
	**/
    public function getOrderInfo($orderId) 
    {
        $data = [];
        $this->_searchCriteriaBuilder->addFilter('increment_id', $orderId);
		$this->_searchCriteriaBuilder->addFilter('customer_is_guest', ['eq'=>1]);
        $orders = $this->_orderRepositoryInterface->getList(
            $this->_searchCriteriaBuilder->create()
        )->getItems();
        if (count($orders)) {
            $order = reset($orders);
            $data['total'] = $order->getGrandTotal();
			$data['order_status'] = $order->getStatus();
			$data['total_invoiced'] = $order->getTotalInvoiced();
			foreach($order->getItems() as $item) {
                $data['items']['ItemID'] = $item->getItemId();
				$data['items']['sku'] = $item->getSku();
				$data['items']['item_price'] = $item->getPrice();
            }
        }
        return $data;
    }
}
?>