<?php
namespace App\Models;
use CodeIgniter\Model;
class NoteModel extends Model
{
 protected $table = 'note';
 protected $primaryKey = 'id_note';
 protected $allowedFields = ['id_eleve', 'id_semestre', 'id_matiere', 'note', 'resultat'];
}