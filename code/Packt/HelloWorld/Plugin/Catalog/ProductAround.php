<?php
namespace Packt\HelloWorld\Plugin\Catalog;
use Magento\Catalog\Model\Product;
class ProductAround
{
    public function aroundGetName($interceptedInput)
    {
        return "Name of product";
    }
}
//aroundGetName là phương thức around plugin của getName.
//\Magento\Catalog\Model\Product $subject: Đối tượng gốc mà phương thức này can thiệp.
//callable $proceed: Đại diện cho phương thức gốc. Gọi $proceed() để thực thi phương thức gốc.
