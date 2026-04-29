<?php
namespace App\Models;
use CodeIgniter\Model;
class ConfigModel extends Model
{
 protected $table = 'config';
 protected $primaryKey = 'id_config';
 protected $allowedFields = ['id_semestre', 'id_option', 'id_matiere', 'credit'];

 public function getMatiereBySemestre(int $id): array{
    return $this->select('config.id_config, config.credit, semestre.semestre, option.option, matiere.ue, matiere.intitule')
    ->join('semestre', 'semestre.id_semestre = config.id_semestre','left')
    ->join('option', 'option.id_option = config.id_option','left')
    ->join('matiere', 'matiere.id_matiere = config.id_matiere','left')
    ->where('config.id_semestre',$id)
    ->findAll()
    ;
 }

}