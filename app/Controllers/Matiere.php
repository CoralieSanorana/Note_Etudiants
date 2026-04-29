<?php
namespace App\Controllers;
use App\Models\MatiereModel;
class Matiere extends BaseController
{

 public function index()
 {
  $model = new MatiereModel();
  $data['matieres'] = $model->findAll();
  return view('matieres', $data);
 }

}
