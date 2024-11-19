<?php

namespace Migration;

defined('FCPATH') or die("Direct script access denied");

/**
 * Slider_images class
 */
class MySlider extends Migration
{

	public function up()
	{

		$this->addColumn('id int unsigned auto_increment');
		$this->addColumn('image varchar(1024) null');
		$this->addColumn('caption varchar(255) null');
		$this->addColumn('link varchar(1024) null');
		$this->addColumn('description text null');
		$this->addColumn('disabled tinyint(1) default 0 null');

		$this->addPrimaryKey('id');
 
		$this->createTable('my_slider');

	}

	public function down()
	{
		$this->dropTable('my_slider');
	}
}