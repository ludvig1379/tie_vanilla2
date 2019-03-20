<?php
namespace Tie\Competition\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Controller\Result\RawFactory;
use Tie\Competition\Model\CompetitionCollectionFactory;



class Validation extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_resultRawFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ManagerInterface $messageManager,
        RawFactory $resultRawFactory,
        CompetitionCollectionFactory $competitionCollectionFactory
    )
    {
        $this->_resultPageFactory   = $resultPageFactory;
        $this->messageManager       = $messageManager;
        $this->_resultRawFactory    = $resultRawFactory;
        $this->_competitionCollectionFactory = $competitionCollectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->getRequest()->getParams();
        if( $post )
        {
            $error = false;
            $errorId = 0;
            $responseArray = array();
            $responseArray['status'] = 'success';

            // Trim all POST values or if empty apply default value
            if(!isset($post['agree']))  $agree = 0;
            else                        $agree = $post['agree'];

            $firstname = trim($post['firstname']);
            $lastname = trim($post['lastname']);
            $answer = trim($post['answer']);
            $email = trim($post['email']);

            // Check if email is already exists within the database table 'form_competition'
            $dbCollection = $this->_competitionCollectionFactory->create();
            $collection = $dbCollection->getCollection()->addFieldToFilter('email',$email);

            if (count($collection) > 0)
            {
                // email already in the table
                $error = true;
                $errorId++;
            }

            if ($error === true || $errorId > 0)
            {
                $extraError = " 'Email' is required field.";

                $this->messageManager->addErrorMessage(__('Unable to submit your request. '.$extraError));

                $responseArray['status'] = 'error';
                $responseArray['failure'] = 'email';
            }
            else
            {
                $this->_resources = \Magento\Framework\App\ObjectManager::getInstance()
                    ->get('Magento\Framework\App\ResourceConnection');
                $connection= $this->_resources->getConnection();
                $themeTable = $this->_resources->getTableName('form_competition');

                // Set result to array and insert into table --- 'form_competition'
                $data = [
                    ['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'answer' => $answer, 'agree' => $agree]
                ];

                foreach ($data as $bind) {
                    $connection->insertForce($themeTable, $bind);
                }

                $this->messageManager->addSuccessMessage(__("Thank you for submitting your details."));
            }

            $response = $this->_objectManager->get(\Magento\Framework\Json\Helper\Data::class)->jsonEncode($responseArray);
            $this->getResponse()->representJson($response);
        }
    }
}
