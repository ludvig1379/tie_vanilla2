<?php
namespace Tie\Competition\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Upgrade the Catalog module DB scheme
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // Add new column named as --- 'Answer to a question'
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('form_competition'),
                'answer',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 9,
                    'nullable' => false,
                    'default' => '',
                    'comment' => 'Answer to a question'
                ]
            );
        }

        // Add new column named as --- 'Agree to term and conditions'
        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('form_competition'),
                'agree',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => false,
                    'default' => 0,
                    'comment' => 'Agree to term and conditions'
                ]
            );
        }

        // Add new column named as --- 'Date created on'
        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('form_competition'),
                'createdDate',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT,
                    'comment' => 'Date created on'
                ]
            );
        }

        $setup->endSetup();
    }
}
