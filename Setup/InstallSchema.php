<?php
/**
 * Magepow 
 * @category    Magepow 
 * @copyright   Copyright (c) 2014 Magepow (http://www.magepow.com/) 
 * @license     http://www.magepow.com/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2020-09-30 17:38:38
 * @@Function:
 */
namespace Magepow\FacebookShopIntegration\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * Install schema script
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('magepow_facebook_shop_attribute_mapping')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magepow_facebook_shop_attribute_mapping')
            )
                ->addColumn(
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Entity ID'
                )
                ->addColumn(
                    'facebook_attribute',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Facebook Attribute'
                )
                ->addColumn(
                    'magento_attribute',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Magento Attribute'
                )
                ->setComment('Magepow Facebook Shop Attribute Mapping');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('magepow_facebook_shop_attribute_mapping'),
                $setup->getIdxName(
                    $installer->getTable('magepow_facebook_shop_attribute_mapping'),
                    ['facebook_attribute', 'magento_attribute'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['facebook_attribute', 'magento_attribute'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

        /* Csv log table */
        if (!$installer->tableExists('magepow_facebook_shop_csv_log')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magepow_facebook_shop_csv_log')
            )
                ->addColumn(
                    'csv_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'CSV ID'
                )
                ->addColumn(
                    'generated_by',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Generated By'
                )
                ->addColumn(
                    'product_ids',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    ['nullable' => false],
                    'Product Ids'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Status'
                )
                ->addColumn(
                    'message',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Message'
                )
                ->addColumn(
                    'started_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => true],
                    'Started At'
                )
                ->addColumn(
                    'finished_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => true],
                    'Finished At'
                )
                ->setComment('Magepow Facebook Shop CSV Log');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('magepow_facebook_shop_csv_log'),
                $setup->getIdxName(
                    $installer->getTable('magepow_facebook_shop_csv_log'),
                    ['generated_by', 'product_ids', 'status', 'message'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['generated_by', 'product_ids', 'status', 'message'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}
