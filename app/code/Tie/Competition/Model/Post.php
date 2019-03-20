<?php
namespace Tie\Competition\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'form_select';

    protected $_cacheTag = 'form_select';

    protected $_eventPrefix = 'form_select';

    protected function _construct()
    {
        $this->_init('Tie\Competition\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
