<?php
namespace App\Models;
use CodeIgniter\Model;
class EleveModel extends Model
{
 protected $table = 'eleve';
 protected $primaryKey = 'id_eleve';
 protected $allowedFields = ['etu', 'nom', 'prenom', 'date_naissance', 'lieu_naissance'];
}
