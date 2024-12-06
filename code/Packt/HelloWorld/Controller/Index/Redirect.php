<?php
namespace Packt\HelloWorld\Controller\Index;
class Redirect extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
//        $this->_redirect('helloworld'); //tao 1 phan hoi http va ke thuc thuc thi action hien tai
        $this->_forward('index'); // giu nguyen yeu cau hien taij va chuyen den action khac ma khong ket thuc viec thuc thi action hien tai
    }
}
