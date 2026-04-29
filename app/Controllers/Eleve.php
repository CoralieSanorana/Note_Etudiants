<?php
namespace App\Controllers;
use App\Models\EleveModel;
use App\Models\MatiereModel;
use App\Models\SemestreModel;
use App\Models\NoteModel;
use App\Models\OptionModel;
use App\Models\ConfigModel;

class Eleve extends BaseController
{

 public function index()
 {
  $model = new EleveModel();
  $data['eleves'] = $model->findAll();
  return view('eleves', $data);
 }

 public function edit()
 {
  $eleveModel = new EleveModel();
  $semestreModel = new SemestreModel();
  $matiereModel = new MatiereModel();
  $noteModel = new NoteModel();  
  $data = [
            'eleves'    => $eleveModel->findAll(),
            'semestres' => $semestreModel->findAll(),
            'matieres' => $matiereModel->findAll(),
            'notes' => $noteModel->getAllNotes(),
        ];
  return view('Formulaire', $data);
 }

 public function storeNote()
 {
  $noteModel = new NoteModel();
  
  $data = [
   'id_eleve' => $this->request->getPost('id_eleve'),
   'id_semestre' => $this->request->getPost('id_semestre'),
   'id_matiere' => $this->request->getPost('id_matiere'),
   'note' => $this->request->getPost('note'),
   'resultat' => $this->request->getPost('note') >= 10 ? 'Validé' : 'Échoué',
  ];
  
  if ($noteModel->insert($data)) {
   return redirect()->to('/form')->with('success', 'Note enregistrée avec succès.');
  } else {
   return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement de la note.');
  }
 }

 public function view($id)
 {
  $model = new EleveModel();
  $semestreModel = new SemestreModel();
  $configModel = new ConfigModel();
  $noteModel = new NoteModel(); 
  $optionModel = new OptionModel();

  $data['eleve'] = $model->find($id);
  $semestres = $semestreModel->findAll();
  
  // Construire le relevé de notes par semestre
  $transcript = [];
  foreach ($semestres as $semestre) {
   $semestreData = [
    'id_semestre' => $semestre['id_semestre'],
    'semestre' => $semestre['semestre'],
    'option_flag' => $semestre['option'],
    'options' => []
   ];
   
   // Récupérer les configs pour ce semestre avec les données matiere
   $configsForSemestre = $configModel
    ->select('config.id_config, config.id_matiere, config.id_option, config.credit, matiere.ue, matiere.intitule')
    ->join('matiere', 'matiere.id_matiere = config.id_matiere', 'left')
    ->where('config.id_semestre', $semestre['id_semestre'])
    ->findAll();
   
    $semestreTotalCredits = 0;
    $semestreTotalPoints = 0;
   
   if ($semestre['option'] == 1) {
    // Grouper par option
    $optionsMap = [];
    foreach ($configsForSemestre as $config) {
     $optionId = $config['id_option'];
     if (!isset($optionsMap[$optionId])) {
      $optionsMap[$optionId] = [];
     }
     $optionsMap[$optionId][] = $config;
    }
    
    foreach ($optionsMap as $optionId => $configs) {
     $optionName = 'Option ' . ($optionId ?: 'N/A');
     if ($optionId) {
      $option = $optionModel->find($optionId);
      if ($option) $optionName = $option['option'];
     }
     
     $optionData = [
      'name' => $optionName,
      'matieres' => []
     ];
     
     $totalCredits = 0;
     $totalPoints = 0;
     
     foreach ($configs as $config) {
      $matiereNotes = $noteModel->where('id_eleve', $id)
       ->where('id_semestre', $semestre['id_semestre'])
       ->where('id_matiere', $config['id_matiere'])
       ->orderBy('note', 'DESC')
       ->findAll();
      
      $bestNote = !empty($matiereNotes) ? $matiereNotes[0]['note'] : 0;
      $credit = $config['credit'] ?: 0;
      $totalCredits += $credit;
      $totalPoints += ($bestNote * $credit);
      
      $optionData['matieres'][] = [
       'ue' => $config['ue'] ?? '',
       'intitule' => $config['intitule'] ?? '',
       'credit' => $credit,
       'note' => $bestNote,
       'resultat' => $bestNote >= 10 ? 'Validé' : 'Échoué'
      ];
     }
     
     $optionData['totalCredits'] = $totalCredits;
     $optionData['moyenne'] = $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0;
    $optionData['resultat'] = $optionData['moyenne'] >= 10 ? 'Validé' : 'Échoué';
     $semestreData['options'][] = $optionData;
    $semestreTotalCredits += $totalCredits;
    $semestreTotalPoints += $totalPoints;
    }
   } else {
    // Pas d'option, toutes les matières du semestre
    $optionData = [
    'name' => 'Toutes les matières',
     'matieres' => []
    ];
    
    $totalCredits = 0;
    $totalPoints = 0;
    
    foreach ($configsForSemestre as $config) {
     $matiereNotes = $noteModel->where('id_eleve', $id)
      ->where('id_semestre', $semestre['id_semestre'])
      ->where('id_matiere', $config['id_matiere'])
      ->orderBy('note', 'DESC')
      ->findAll();
     
     $bestNote = !empty($matiereNotes) ? $matiereNotes[0]['note'] : 0;
     $credit = $config['credit'] ?: 0;
     $totalCredits += $credit;
     $totalPoints += ($bestNote * $credit);
     
     
     $optionData['matieres'][] = [
      'ue' => $config['ue'] ?? '',
      'intitule' => $config['intitule'] ?? '',
      'credit' => $credit,
      'note' => $bestNote,
      'resultat' => $bestNote >= 10 ? 'Validé' : 'Échoué'
     ];
    }
    
    $optionData['totalCredits'] = $totalCredits;
    $optionData['moyenne'] = $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0;
        $optionData['resultat'] = $optionData['moyenne'] >= 10 ? 'Validé' : 'Échoué';
    $semestreData['options'][] = $optionData;
        $semestreTotalCredits = $totalCredits;
        $semestreTotalPoints = $totalPoints;
   }
   
     $semestreData['totalCredits'] = $semestreTotalCredits;
     $semestreData['moyenne'] = $semestreTotalCredits > 0 ? round($semestreTotalPoints / $semestreTotalCredits, 2) : 0;
     $semestreData['resultat'] = $semestreData['moyenne'] >= 10 ? 'Validé' : 'Échoué';

   $transcript[] = $semestreData;
  }
  
  $data['transcript'] = $transcript;

  return view('eleve_view', $data);
 }
}
