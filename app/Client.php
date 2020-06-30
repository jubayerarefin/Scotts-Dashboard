<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $_table      = 'user';
    protected $_primaryKey = 'userId';
    public $incrementing   = false;
    const CREATED_AT       = 'CreatedAt';
    const UPDATED_AT       = 'UpdatedAt';
    protected $_connection  = 'mysql2';
}