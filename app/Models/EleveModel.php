<?php
namespace App\Models;
use CodeIgniter\Model;
class EleveModel extends Model
{
 protected $table = 'eleve';
 protected $primaryKey = 'id_eleve';
 protected $allowedFields = ['etu', 'nom', 'prenom', 'date_naissance', 'lieu_naissance'];

 public function getEleveNote(int $id): array{
    return $this->select('eleve.id_eleve, eleve.etu, eleve.nom, eleve.prenom, eleve.date_naissance, eleve.lieu,naissance')
    ->join('note', 'note.id_eleve = eleve.id_eleve','left')
    ->join('config', 'config.id_semestre = note.id-semestre','left')
    ->join('semestre', 'semestre.id_semestre = config.id_semestre','left')
    ->join('matiere', 'matiere.id_matiere = config.id_matiere','left')


    ->where('eleve.id_eleve',$id)
    ;
 }

}
