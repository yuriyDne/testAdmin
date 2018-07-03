<?php

namespace Test\ContactRequest\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $this->createContactTable($installer);

        $installer->endSetup();
    }

    /**
     * @param SchemaSetupInterface $installer
     *
     * @return void
     * @throws \Zend_Db_Exception
     */
    private function createContactTable($installer)
    {
        $tableName = $installer->getTable('contact_request');
        $this->dropTableIfExists($installer, $tableName);

        $contactTable = $installer->getConnection()->newTable($tableName);
        $contactTable = $this->addColumnsToContactTable($contactTable);

        $contactTable->setComment('Contact Request');
        $installer->getConnection()->createTable($contactTable);
    }

    /**
     * @param $installer SchemaSetupInterface
     * @param $table string
     */
    private function dropTableIfExists($installer, $table)
    {
        if ($installer->getConnection()->isTableExists($installer->getTable($table))) {
            $installer->getConnection()->dropTable(
                $installer->getTable($table)
            );
        }
    }


    /**
     * @param Table $contactTable
     *
     * @return Table
     * @throws \Zend_Db_Exception
     */
    private function addColumnsToContactTable($contactTable)
    {
        return $contactTable->addColumn(
            'request_id',
            Table::TYPE_INTEGER,
            10,
            [
                'primary' => true,
                'identity' => true,
                'unsigned' => true,
                'nullable' => false
            ],
            'Primary Key'
        )->addColumn(
            'status',
            Table::TYPE_SMALLINT,
            null,
            [
                'unsigned' => true,
                'nullable' => false,
                'default' => '0',
            ],
            'Request Status'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            50,
            [
                'unsigned' => true,
                'nullable' => false,
            ],
            'Customer Name'
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            50,
            [
                'unsigned' => true,
                'nullable' => false,
            ],
            'Customer Email'
        )->addColumn(
            'phone',
            Table::TYPE_TEXT,
            30,
            [
                'unsigned' => true,
                'nullable' => true,
            ],
            'Customer Phone'
        )->addColumn(
            'request',
            Table::TYPE_TEXT,
            null,
            [
                'unsigned' => true,
                'nullable' => false,
            ],
            'Customer request'
        )->addColumn(
            'response',
            Table::TYPE_TEXT,
            null,
            [
                'unsigned' => true,
                'nullable' => true,
            ],
            'Customer response'
        );
    }
}
