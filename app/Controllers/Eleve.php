<?php
namespace App\Controllers;
use App\Models\EleveModel;
use App\Models\MatiereModel;
use App\Models\SemestreModel;

class Eleve extends BaseController
{

 public function index()
 {
  $model = new EleveModel();
  $data['eleves'] = $model->findAll();
  return view('eleves', $data);
 }

 public function edit($id)
 {
  $eleveModel = new EleveModel();
  $semestreModel = new SemestreModel();
  $matiereModel = new MatiereModel();  
  $data = [
            'eleve'    => $this->eleveModel->find($id),
            'semestres' => $this->semestreModel->findAll(),
            'matieres' => $this->matiereModel->findAll(),
        ];
  return view('eleve_form', $data);
 }

 public function view($id)
 {
  $model = new EleveModel();
  $data['eleve'] = $model->find($id);
  return view('eleve_view', $data);
 }
}
