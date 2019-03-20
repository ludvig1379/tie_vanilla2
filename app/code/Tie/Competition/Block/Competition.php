<?php
namespace Tie\Competition\Block;

class Competition extends \Magento\Framework\View\Element\Template
{
    public $_postFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Tie\Competition\Model\PostFactory $postFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_postFactory = $postFactory;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    //  Text for page heading
    public function getCompetitionTxt()
    {
        return 'Competition';
    }

    //  Get you URL for validation action page
    public function getValidationUrl()
    {
        return $this->getUrl('competition/index/validation', ['_secure' => true]);
    }

    //  Get you URL for validation action page
    public function getPostVariables()
    {
        return $this->getRequest()->getParams();
    }

    //  Get the list for drop down select
    public function getDropdownOptions()
    {
        // Set Connection to MySQL table --- 'form_competition'
        $option = '';

        $post = $this->_postFactory->create();
        $collection = $post->getCollection();
        foreach($collection as $item){
            $option .= $item->getData()['begin_option'] . $item->getData()['middle_value'] . $item->getData()['end_option'];
        }

        return $option;
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
}
