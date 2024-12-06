<?php
namespace Packt\HelloWorld\Block;
use Magento\Framework\View\Element\Template;
class Newproducts extends Template
{
    private $_productCollectionFactory;
    public function __construct(
        Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->_productCollectionFactory = $productCollectionFactory;
    }
    public function getProducts() {
        $collection = $this->_productCollectionFactory->create();
        $collection
            ->addAttributeToSelect(['name', 'price', 'image'])  // Chọn các thuộc tính cần thiết
            ->setOrder('created_at', 'DESC')  // Sắp xếp theo ngày tạo giảm dần
            ->setPageSize(5)  // Giới hạn số lượng sản phẩm hiển thị
            ->setFlag('has_stock_status_filter', false);
        // Kiểm tra số lượng sản phẩm trong collection
        $productCount = $collection->getSize();
        $product = $collection->getItems();
        \Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class)->info("Product count: " . $productCount);

        return $collection;
    }

    public function getNumProducts() {
        $collection = $this->_productCollectionFactory->create();
        $collection
            ->addAttributeToSelect(['name', 'price', 'image'])  // Chọn các thuộc tính cần thiết
            ->addAttributeToFilter('status', \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED) // Lọc sản phẩm còn hoạt động
            ->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH) // Lọc sản phẩm có thể nhìn thấy
            ->setOrder('created_at', 'DESC')  // Sắp xếp theo ngày tạo giảm dần
            ->setPageSize(5);  // Giới hạn số lượng sản phẩm hiển thị

        // Kiểm tra số lượng sản phẩm trong collection
        $productCount = $collection->getSize();
        \Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class)->info("Product count: " . $productCount);

        return $productCount;
    }
}
