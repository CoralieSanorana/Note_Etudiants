<?php
namespace App\Models;
use CodeIgniter\Model;
class EleveModel extends Model
{
 protected $table = 'eleve';
 protected $primaryKey = 'id_eleve';
 protected $allowedFields = ['etu', 'nom', 'prenom', 'date_naissance', 'lieu_naissance'];

 public function getEleveNotes(int $id): array{
    return $this->select('eleve.id_eleve, eleve.etu, note.note, note.resultat, note.id_semestre, semestre.semestre,note.id_matiere, matiere.ue, matiere.intitule')
    ->join('note', 'note.id_eleve = eleve.id_eleve','left')
    ->join('semestre', 'semestre.id_semestre = config.id_semestre','left')
    ->join('matiere', 'matiere.id_matiere = config.id_matiere','left')
    ->where('eleve.id_eleve',$id)
    ;
 }

 

}
