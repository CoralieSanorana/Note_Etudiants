<?php
namespace App\Models;
use CodeIgniter\Model;
class ConfigModel extends Model
{
 protected $table = 'config';
 protected $primaryKey = 'id_config';
 protected $allowedFields = ['id_semestre', 'id_option', 'id_matiere', 'credit'];
}