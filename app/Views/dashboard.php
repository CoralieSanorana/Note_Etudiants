<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SysInfo — Tableau de bord</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
</head>
<body>

<div class="app">

  <!-- ── Sidebar ──────────────────────────────────────────────────────────── -->
  <?= view('header', ['activeMenu' => 'dashboard', 'elevesCount' => isset($eleves) ? count($eleves) : null]) ?>


  <!-- ── Main ─────────────────────────────────────────────────────────────── -->
  <div class="main">

    <div class="topbar">
      <div class="topbar-title">Tableau de bord</div>
    </div>

    <div class="content">

      <div class="page-header">
        <div>
          <h2>Accueil</h2>
          <div class="breadcrumb">Accueil / <span>Tableau de bord</span></div>
        </div>
        <a href="/eleves" class="btn btn-primary btn-sm">Voir les élèves</a>
      </div>

      <div class="dash-grid">

        <div class="card">
          <div class="card-header">
            <div class="card-title">Gestion des élèves</div>
          </div>
          <p style="margin:0 0 16px;color:var(--c-muted);line-height:1.6">
            Consultez la liste des élèves, ouvrez une fiche détaillée et enregistrez les notes depuis le formulaire.
          </p>
          <div style="display:flex;gap:10px;flex-wrap:wrap">
            <a href="/eleves" class="btn btn-primary btn-sm">Voir les élèves</a>
            <a href="/form" class="btn btn-secondary btn-sm">Saisir une note</a>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="card-title">Raccourcis</div>
          </div>
          <div style="display:flex;flex-direction:column;gap:12px">
            <a href="/eleves" style="display:flex;justify-content:space-between;align-items:center;padding:12px 14px;border:1px solid var(--c-border);border-radius:12px;color:inherit;text-decoration:none">
              <span>Liste des élèves</span>
              <strong>Ouvrir</strong>
            </a>
            <a href="/form" style="display:flex;justify-content:space-between;align-items:center;padding:12px 14px;border:1px solid var(--c-border);border-radius:12px;color:inherit;text-decoration:none">
              <span>Formulaire des notes</span>
              <strong>Ouvrir</strong>
            </a>
            <a href="/eleves/1/view" style="display:flex;justify-content:space-between;align-items:center;padding:12px 14px;border:1px solid var(--c-border);border-radius:12px;color:inherit;text-decoration:none">
              <span>Exemple de relevé</span>
              <strong>Voir</strong>
            </a>
          </div>
        </div>

      </div>

      <div class="card" style="margin-top:24px">
        <div class="card-header">
          <div class="card-title">À faire</div>
        </div>
        <ul style="margin:0;padding-left:18px;color:var(--c-muted);line-height:1.8">
          <li>Consulter la liste des élèves.</li>
          <li>Ajouter ou modifier une note.</li>
          <li>Ouvrir le relevé de notes d’un élève.</li>
        </ul>
      </div>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /app -->

</body>
</html>
