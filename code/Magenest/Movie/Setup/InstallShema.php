<?php

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallShema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $connection = $setup->getConnection();
        //Table magenest_director
        if (!$connection->isTableExists($setup->getTable('magenest_director'))) {
            $table = $connection->newTable($setup->getTable('magenest_director'))
                ->addColumn('director_id', Table::TYPE_INTEGER, null, array(
                    'identity' => true, //auto increment
                    'unsigned' => true, //No negative numbers
                    'nullable' => false, // No null text
                    'primary' => true // Khoa chinh
                ),
                    'Director ID')
                ->addColumn('name', Table::TYPE_TEXT, 255, array(
                    'nullable' => false,
                    'unsigned' => true,
                ),
                    'Director Name'
                )
                ->setcomment('Director Table');
            $connection->createTable($table);
        }

        // Tạo bảng magenest_actor
        if (!$connection->isTableExists($setup->getTable('magenest_actor'))) {
            $table = $connection->newTable(
                $setup->getTable('magenest_actor')
            )
                ->addColumn(
                    'actor_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Actor ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Actor Name'
                )
                ->setComment('Actor Table');
            $connection->createTable($table);
        }

        //Table magenest_movie
        if (!$connection->isTableExists($setup->getTable('magenest_movie'))) {
            $table = $connection->newTable($setup->getTable('magenest_movie'))
                ->addColumn('movie_id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                    'Movie ID')
                ->addColumn('name', Table::TYPE_TEXT, 255, array(
                    'nullable' => false,
                    'unsigned' => true,
                ), 'Movie Name'
                )
                ->addColumn('description', Table::TYPE_TEXT, 255, array(
                    'nullable' => false,
                    'unsigned' => true,
                ))
                ->addColumn('rating', Table::TYPE_INTEGER, null, array(
                    'nullable' => false,
                    'unsigned' => true,
                ), 'Movie Rating'
                )
                ->addColumn(
                    'director_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'nullable' => false],
                    'Director ID')
                ->addColumn(
                    $setup->getFkName('magenest_movie', 'director_id', 'magenest_director', 'director_id'), 'director_id',
                    $setup->getTable('magenest_director'), 'director_id', Table::ACTION_CASCADE
                )
                ->setcomment('Movie Table');
            $connection->createTable($table);
        }
        // Tạo bảng magenest_movie_actor
        if (!$connection->isTableExists($setup->getTable('magenest_movie_actor'))) {
            $table = $connection->newTable(
                $setup->getTable('magenest_movie_actor')
            )
                ->addColumn(
                    'movie_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'nullable' => false],
                    'Movie ID'
                )
                ->addColumn(
                    'actor_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'nullable' => false],
                    'Actor ID'
                )
                ->addForeignKey(
                    $setup->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                    'movie_id',
                    $setup->getTable('magenest_movie'),
                    'movie_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                    'actor_id',
                    $setup->getTable('magenest_actor'),
                    'actor_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Movie Actor Table');
            $connection->createTable($table);
        }
        $setup->endSetup();
    }
}
