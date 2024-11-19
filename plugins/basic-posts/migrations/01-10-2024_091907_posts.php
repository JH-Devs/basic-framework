<?php

namespace Migration;

defined('FCPATH') or die ("Direct script access denied.");

class Posts extends Migration
{
    public function up()
    {
        $this->addColumn('id int unsigned auto_increment');

        $this->addColumn('user_id int null');
        $this->addColumn('title varchar(100) null');
        $this->addColumn('image varchar(1024) null');
        $this->addColumn('seo_title varchar(100) null');
        $this->addColumn('seo_description varchar(255) null');
        $this->addColumn('keywords varchar(255) null');
        $this->addColumn('slug varchar(100) null');
        $this->addColumn('content mediumtext null');
        $this->addColumn('views int default 0');
        $this->addColumn('display_title tinyint(1) default 1');
        $this->addColumn('display_featured_image tinyint(1) default 1');

        $this->addColumn('disabled tinyint unsigned default 0');
        $this->addColumn('date_created datetime default null');
        $this->addColumn('date_updated datetime default null');
        $this->addColumn('date_disabled datetime default null');

        $this->addPrimaryKey('id');
        $this->addKey('user_id');
        $this->addKey('title');
        $this->addKey('slug');
        $this->addKey('views');
        $this->addKey('disabled');
        $this->addKey('date_created');

        $this->createTable('posts');
    }
    public function down()
    {
        $this->dropTable('posts');
    }
}