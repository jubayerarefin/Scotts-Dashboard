<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $_table      = 'organization';
    protected $_primaryKey = 'OrganizationId';
    public $incrementing   = false;
    const CREATED_AT       = 'CreatedAt';
    const UPDATED_AT       = 'UpdatedAt';
    protected $_connection = 'mysql2';
}