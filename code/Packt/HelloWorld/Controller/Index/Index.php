<?php

namespace Packt\HelloWorld\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    // Khai báo PageFactory để tạo một trang kết quả

    //    /** @var \Magento\Framework\View\Result\PageFactory*/
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    // Phương thức execute() để thực thi hành động của controller

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();// Tạo một đối tượng trang kết quả
        return $resultPage; // Tra ve 1 trang
    }
}
