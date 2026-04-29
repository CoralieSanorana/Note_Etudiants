<?php
namespace App\Models;
use CodeIgniter\Model;
class MatiereModel extends Model
{
 protected $table = 'matiere';
 protected $primaryKey = 'id_matiere';
 protected $allowedFields = ['ue', 'intitule'];
}