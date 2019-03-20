<?php
namespace Tie\Competition\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id_dropdown';
    protected $_eventPrefix = 'form_select_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tie\Competition\Model\Post', 'Tie\Competition\Model\ResourceModel\Post');
    }
}
