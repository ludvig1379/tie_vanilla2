<?php
namespace Tie\Competition\Model;
class CompetitionCollection extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'form_competition';

    protected $_cacheTag = 'form_competition';

    protected $_eventPrefix = 'form_competition';

    protected function _construct()
    {
        $this->_init('Tie\Competition\Model\ResourceModel\CompetitionCollection');
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
