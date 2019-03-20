<?php
namespace Tie\Competition\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Create table 'greeting_message'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('form_competition'))
            ->addColumn(
                'competition_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Competition ID'
            )
            ->addColumn(
                'firstname',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                350,
                ['nullable' => false, 'default' => ''],
                'First Name'
            )
            ->addColumn(
                'lastname',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                350,
                ['nullable' => false, 'default' => ''],
                'First Name'
            )
            ->addColumn(
                'email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                275,
                ['nullable' => false, 'default' => ''],
                'Email'
            )->setComment("Competition table");
        $setup->getConnection()->createTable($table);
    }
}
