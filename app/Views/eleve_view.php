<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SysInfo — Détail élève</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
</head>
<body>

<div class="app">
<?= view('header', ['activeMenu' => 'eleves']) ?>

  <!-- ── Main ─────────────────────────────────────────────────────────────── -->
  <div class="main">
    <div class="topbar">
      <div class="topbar-title">Fiche élève</div>
      <div class="topbar-actions">
        <a href="/eleves" class="btn btn-secondary btn-sm">Retour à la liste</a>
      </div>
    </div>

    <div class="content">
      <?php if (!empty($eleve)) : ?>
        <div class="page-header">
          <div>
            <h2><?= esc($eleve['nom'] ?? '') ?> <?= esc($eleve['prenom'] ?? '') ?></h2>
            <div class="breadcrumb">Accueil / Élèves / <span>Détail</span></div>
          </div>
          <div style="display:flex;gap:10px">
            <a href="/eleves/<?= esc($eleve['id_eleve'] ?? '') ?>/form" class="btn btn-primary btn-sm">Modifier</a>
          </div>
        </div>

        <div class="table-card" style="padding:24px">
          <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px">
            <div>
              <div style="font-size:12px;color:var(--c-muted);text-transform:uppercase;letter-spacing:.06em">Matricule</div>
              <div style="font-size:18px;font-weight:600"><?= esc($eleve['etu'] ?? '') ?></div>
            </div>
            <div>
              <div style="font-size:12px;color:var(--c-muted);text-transform:uppercase;letter-spacing:.06em">Identifiant</div>
              <div style="font-size:18px;font-weight:600"><?= esc($eleve['id_eleve'] ?? '') ?></div>
            </div>
            <div>
              <div style="font-size:12px;color:var(--c-muted);text-transform:uppercase;letter-spacing:.06em">Nom</div>
              <div style="font-size:18px;font-weight:600"><?= esc($eleve['nom'] ?? '') ?></div>
            </div>
            <div>
              <div style="font-size:12px;color:var(--c-muted);text-transform:uppercase;letter-spacing:.06em">Prénom</div>
              <div style="font-size:18px;font-weight:600"><?= esc($eleve['prenom'] ?? '') ?></div>
            </div>
            <div>
              <div style="font-size:12px;color:var(--c-muted);text-transform:uppercase;letter-spacing:.06em">Date de naissance</div>
              <div style="font-size:18px;font-weight:600"><?= esc($eleve['date_naissance'] ?? '') ?></div>
            </div>
            <div>
              <div style="font-size:12px;color:var(--c-muted);text-transform:uppercase;letter-spacing:.06em">Lieu de naissance</div>
              <div style="font-size:18px;font-weight:600"><?= esc($eleve['lieu_naissance'] ?? '') ?></div>
            </div>
          </div>
        </div>
      <?php else : ?>
        <div class="table-card" style="padding:24px;text-align:center;color:var(--c-muted)">
          Aucun élève trouvé.
        </div>
      <?php endif; ?>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /app -->

</body>
</html>
