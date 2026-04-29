<?php
namespace App\Models;
use CodeIgniter\Model;
class NoteModel extends Model
{
 protected $table = 'note';
 protected $primaryKey = 'id_note';
 protected $allowedFields = ['id_eleve', 'id_semestre', 'id_matiere', 'note', 'resultat'];

 public function getEleveNotes(int $id): array{
    return $this->select('note.id_note, note.note, note.resultat, note.id_semestre, semestre.semestre,note.id_matiere, matiere.ue, matiere.intitule')
    ->join('semestre', 'semestre.id_semestre = note.id_semestre','left')
    ->join('matiere', 'matiere.id_matiere = note.id_matiere','left')
    ->where('note.id_eleve',$id)
    ->findAll()
    ;
 }

 public function getAllNotes(): array {
    return $this->select('note.id_note, note.note, note.resultat, eleve.id_eleve, eleve.etu, eleve.nom, eleve.prenom, semestre.semestre, matiere.ue, matiere.intitule')
    ->join('eleve', 'eleve.id_eleve = note.id_eleve', 'left')
    ->join('semestre', 'semestre.id_semestre = note.id_semestre', 'left')
    ->join('matiere', 'matiere.id_matiere = note.id_matiere', 'left')
    ->orderBy('note.id_note', 'DESC')
    ->findAll();
 }
}