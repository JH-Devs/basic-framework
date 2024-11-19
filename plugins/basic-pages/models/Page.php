<?php

namespace BasicPages;
use \Model\Model;


defined('ROOT') or die ("Direct script access denied.");

class Page extends Model
{
    protected $table = 'pages';

    public $primary_key = 'id';

    protected $allowedColumns = [
        
        'user_id',
        'title',
        'image',
        'seo_title',
        'seo_description',
        'keywords',
        'slug',
        'content',
        'views',
        'display_title',
        'disabled',
        'date_created',
        'display_featured_image',
        'show_contact_form'
    ];
    protected $allowedUpdateColumns = [
        'user_id',
        'title',
        'image',
        'seo_title',
        'seo_description',
        'keywords',
        'slug',
        'content',
        'views',
        'display_title',
        'disabled',
        'date_updated',
        'date_disabled',
        'display_featured_image',
        'show_contact_form'
    ];

    public function validate_insert(array $data) : bool
    {
        if (empty($data['title'])) {

            $this->errors['title'] = 'A title is required';
        } 
        return empty($this->errors);
    }
    public function validate_update(array $data) :bool
    {
       if (empty($data['title'])) {
            
            $this->errors['title'] = 'A title is required';
        } 
        return empty($this->errors);
    }
}