<?php
use SLiMS\Migration\Migration;
use SLiMS\Table\Blueprint;
use SLiMS\Table\Schema;

class CreateBase extends Migration
{
    protected string $connection = 'SLiMS';

    function __construct(string $connection = '')
    {
        if (!empty($connection)) {
            $this->connection = $connection;
        }
    }

    function up()
    {
        $schema = Schema::connection($this->connection);

        $schema->create('mantri_sub_vena', function(Blueprint $table){
            $table->autoIncrement('id');
            $table->string('unique_id', 32)->notNull();
            $table->string('ip', 50)->notNull();
            $table->string('member_id', 20)->nullable();
            $table->text('payload')->notNull();
            $table->datetime('accessed_at');
            $table->index('unique_id');
            $table->index('ip');
            $table->fulltext('payload');
        });

        $schema->create('mantri_sub_cardio', function(Blueprint $table){
            $table->autoIncrement('id');
            $table->number('cpu', 3)->default(0);
            $table->number('ram', 11)->default(0);
            $table->datetime('capture_at');
            $table->index('cpu');
            $table->index('ram');
        });

        $schema->create('mantri_sub_bag', function(Blueprint $table){
            $table->autoIncrement('id');
            $table->text('sub')->notNull();
            $table->datetime('created_at');
        });

        $schema->create('mantri_sub_monitor', function(Blueprint $table) {
            $table->autoIncrement('id');
            $table->text('position')->notNull();
            $table->text('message')->notNull();
            $table->datetime('created_at');
        });
    }

    function down()
    {

    }
}