<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class ChecksMigration_101
 */
class ChecksMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('checks', [
            'columns' => [
                new Column(
                    'check_id',
                    [
                        'type' => Column::TYPE_BIGINTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 20,
                        'first' => true
                    ]
                ),
                new Column(
                    'datetime',
                    [
                        'type' => Column::TYPE_DATETIME,
                        'notNull' => true,
                        'after' => 'check_id'
                    ]
                ),
                new Column(
                    'http',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 3,
                        'after' => 'datetime'
                    ]
                ),
                new Column(
                    'try_no',
                    [
                        'type' => Column::TYPE_TINYINTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 3,
                        'after' => 'http'
                    ]
                ),
                new Column(
                    'url_id',
                    [
                        'type' => Column::TYPE_BIGINTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 20,
                        'after' => 'try_no'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['check_id'], 'PRIMARY'),
                new Index('checks_FK', ['url_id'], ''),
            ],
            'references' => [
                new Reference(
                    'checks_FK',
                    [
                        'referencedSchema' => 'url_checker',
                        'referencedTable' => 'urls',
                        'columns' => ['url_id'],
                        'referencedColumns' => ['url_id'],
                        'onUpdate' => 'CASCADE',
                        'onDelete' => 'CASCADE'
                    ]
                ),
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '1',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8mb4_general_ci',
            ],
        ]);
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up(): void
    {
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down(): void
    {
    }
}
