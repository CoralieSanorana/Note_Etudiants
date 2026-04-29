<?php
namespace App\Controllers;
use App\Models\SemestreModel;
class Semestre extends BaseController
{

 public function index()
 {
  $model = new SemestreModel();
  $data['semestre'] = $model->findAll();
  return view('semestre', $data);
 }

}
