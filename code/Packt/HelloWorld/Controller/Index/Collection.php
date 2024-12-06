<?php

namespace Packt\HelloWorld\Controller\Index;


class Collection extends \Magento\Framework\App\Action\Action
{
    public function execute1()
    {
        $productCollection = $this->_objectManager
            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->addAttributeToSelect('*')  // Chọn các thuộc tính cần thiết
            ->setOrder('created_at', 'DESC')  // Sắp xếp theo ngày tạo giảm dần
            ->setPageSize(10)  // Giới hạn số lượng sản phẩm hiển thị
            ->setFlag('has_stock_status_filter', false);
        $output = '';
        foreach ($productCollection as $product) {
            $output .= '<pre>' . var_export($product->getData(), true) . '</pre>';
        }
        $this->getResponse()->setBody($output);
    }

    public function execute2()
    {
        $productCollection = $this->_objectManager
            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->setPageSize(10, 1)
            ->setFlag('has_stock_status_filter', false);
        $output = '';
        foreach ($productCollection as $product) {
            $output .= '<pre>' . var_export($product->getData(), true) . '</pre>';
        }

        $this->getResponse()->setBody($output);
    }

    public function execute3()
    {
        $productCollection = $this->_objectManager
            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->addAttributeToSelect([
                'name',
                'price',
                'image',
            ])
            ->setPageSize(10, 1)
            ->setFlag('has_stock_status_filter', false);
        $output = '';
        foreach ($productCollection as $product) {
            $output .= '<pre>' . var_export($product->getData(), true) . '</pre>';
        }
        $this->getResponse()->setBody($output);
    }

    public function execute4()
    {
        $productCollection = $this->_objectManager
            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->addAttributeToSelect([
                'name',
                'price',
                'image',
            ])
            ->addAttributeToFilter('name', 'Overnight Duffle')
            ->setFlag('has_stock_status_filter', false);
        $output = '';
        foreach ($productCollection as $product) {
            $output .= '<pre>' . var_export($product->getData(), true) . '</pre>';
        }
        $this->getResponse()->setBody($output);
    }

    public function execute()
    {
        $productCollection = $this->_objectManager
            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->addAttributeToSelect([
                'name',
                'price',
                'image',
            ])
            ->addAttributeToFilter('entity_id', array('in' => array(159, 160, 161)))
            ->setFlag('has_stock_status_filter', false);
        $output = '';
        foreach ($productCollection as $product) {
            $output .= '<pre>' . var_export($product->getData(), true) . '</pre>';
        }
        $this->getResponse()->setBody($output);
    }

    public function execute5()
    {
        $productCollection = $this->_objectManager
            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->addAttributeToSelect([
                'name',
                'price',
                'image',
            ])
            ->addAttributeToFilter('name', array('like' => '%Sport%'))
            ->setFlag('has_stock_status_filter', false);
        $output = '';
        foreach ($productCollection as $product) {
            $output .= '<pre>' . var_export($product->getData(), true) . '</pre>';
        }
        $this->getResponse()->setBody($output);
    }

    public function execute6()
    {
        $productCollection = $this->_objectManager
            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->addAttributeToSelect([
                'name',
                'price',
                'image',
            ])
            ->addAttributeToFilter('name', array('like' => '%Sport%'))
            ->setFlag('has_stock_status_filter', false);

        $output = $productCollection->getSelect()->__toString();
        $this->getResponse()->setBody($output);
    }
}
