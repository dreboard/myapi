<?php
namespace App\Models;
/**
 * User ORM.
 * User shell class used as a base for the users table
 * uses Illuminate Object Relational Mapper
 *
 * @package     MyAPI\Application
 * @subpackage  Models
 * @author      Andre Board
 * @version     v0.1.0
 * @since       0.1.0
 *
 */

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

}