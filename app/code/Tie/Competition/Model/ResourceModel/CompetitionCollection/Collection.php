<?php
namespace Tie\Competition\Model\ResourceModel\CompetitionCollection;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'competition_id';
    protected $_eventPrefix = 'form_competition_collection';
    protected $_eventObject = 'competitionCollection_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tie\Competition\Model\CompetitionCollection', 'Tie\Competition\Model\ResourceModel\CompetitionCollection');
    }
}
