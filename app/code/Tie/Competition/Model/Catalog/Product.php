<?php
namespace Tie\Competition\Model\Catalog;

class Product extends \Magento\Catalog\Model\Product
{
    /**
     * Get product name
     *
     * @return string
     * @codeCoverageIgnoreStart
     */
    public function getName()
    {
        $modifyProductName = $this->_getData(self::NAME);
        return 'Vax - '.$modifyProductName;
    }
}
