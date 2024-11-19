<?php

namespace MySlider;
use \Model\Model;

defined('ROOT') or die("Direct script access denied");

/**
 * Slider_image class
 */
class MySlider extends Model
{

	protected $table = 'my_slider';
	public $primary_key = 'id';

	protected $allowedColumns = [
		'id',
		'image',
		'caption',
		'link',
		'description',
	];
	
	protected $allowedUpdateColumns = [
		'id',
		'image',
		'caption',
		'link',
		'description',
	];


	public function validate_insert(array $data):bool
	{
 
 		return empty($this->errors);
	}

	public function validate_update(array $data):bool
	{
 
		return empty($this->errors);
	}
}