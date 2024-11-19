<?php

namespace Categories;
use \Model\Model;

defined('ROOT') or die("Direct script access denied");

/**
 * Category class
 */
class Category extends Model
{

	protected $table = 'categories';
	public $primary_key = 'id';

	protected $allowedColumns = [
		'category',
		'slug',
		'disabled',
	];
	
	protected $allowedUpdateColumns = [
		'category',
		'slug',
		'disabled',
	];


	public function validate_insert(array $data):bool
	{

		if(empty($data['category']))
 		{
 			$this->errors['category'] = 'Category name is required';
 		}else
 		if(!preg_match("/^[a-zA-Zá-žÁ-Ž \-]+$/u", trim($data['category'])))
 		{
 			$this->errors['category'] = 'Only letters with no spaces allowed in slug';
 		}
		 else
 		if($this->first(['category'=>$data['category']]))
 		{
 			$this->errors['category'] = 'That category is already in use';
 		}
 
 		return empty($this->errors);
	}

	public function validate_update(array $data):bool
	{
		
		if(empty($data['category']))
		{
			$this->errors['category'] = 'Category is required';
		}else
		if(!preg_match("/^[a-zA-Zá-žÁ-Ž \-]+$/u", trim($data['category'])))
		{
			$this->errors['category'] = 'Only letters with no spaces allowed in category';
		}
		else
 		if($this->first(['category'=>$data['category']]))
 		{
 			$this->errors['category'] = 'That category is already in use';
 		}
		
		return empty($this->errors);
	}
}