<?php
namespace Born\OrderController\Helper;
use Magento\Sales\Api\bornOrder\OrderInterface;
use Magento\Sales\Api\bornOrder\OrderItemInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class OrderbornOrder extends \Magento\Framework\App\Helper\AbstractHelper 
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

    public function getOrderInfo($orderId) 
    {
        $bornOrder = [];
        $this->_searchCriteriaBuilder->addFilter('increment_id', $orderId);
		$this->_searchCriteriaBuilder->addFilter('customer_is_guest', ['eq'=>1]);
        $orders = $this->_orderRepositoryInterface->getList(
            $this->_searchCriteriaBuilder->create()
        )->getItems();
        if (count($orders)) {
            $order = reset($orders);
            $bornOrder['total'] = $order->getGrandTotal();
			$bornOrder['order_status'] = $order->getStatus();
			$bornOrder['total_invoiced'] = $order->getTotalInvoiced();
			foreach($order->getItems() as $item) {
                $bornOrder['items']['ItemID'] = $item->getItemId();
				$bornOrder['items']['sku'] = $item->getSku();
				$bornOrder['items']['item_price'] = $item->getPrice();
            }
        }
        return $bornOrder;
    }
}
?>