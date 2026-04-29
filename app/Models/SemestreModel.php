<?php
namespace App\Models;
use CodeIgniter\Model;
class SemestreModel extends Model
{
 protected $table = 'semestre';
 protected $primaryKey = 'id_semestre';
 protected $allowedFields = ['option','semestre'];
}