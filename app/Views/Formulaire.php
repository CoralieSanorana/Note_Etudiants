<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SysInfo — Formulaire utilisateur</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<div class="app">

  <!-- ── Sidebar ──────────────────────────────────────────────────────────── -->
  <?= view('header', ['activeMenu' => 'form']) ?>


  <!-- ── Main ─────────────────────────────────────────────────────────────── -->
  <div class="main">

    <div class="topbar">
      <div class="topbar-title">Formulaire utilisateur</div>
      <div class="topbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="Rechercher…" />
      </div>
      <div class="topbar-actions">
        <button class="icon-btn">
          <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </button>
        <button class="icon-btn">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
        </button>
      </div>
    </div>

    <div class="content">

      <div class="page-header">
        <div>
          <h2>Eleve</h2>
          <div class="breadcrumb">Accueil / Utilisateurs / <span>Nouveau</span></div>
        </div>
        <a href="list.html" class="btn btn-secondary btn-sm">
          <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
          Retour à la liste
        </a>
      </div>

      <div class="alert alert-info">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>Les champs marqués d'un <strong>*</strong> sont obligatoires. Ce formulaire illustre tous les types de champs disponibles dans le SI.</span>
      </div>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          <span><?= session()->getFlashdata('success') ?></span>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
          <span><?= session()->getFlashdata('error') ?></span>
        </div>
      <?php endif; ?>

      <form method="post" action="/form">
        <?= csrf_field() ?>

        <!-- ── Ajout Note ───────────────────────────────────────── -->
        <div class="form-card section-gap">
          <div class="form-section-title">Ajouter une note</div>
          <div class="form-grid">
            <div>
              <label class="field-label">Eleve <span class="required">*</span></label>
              <select name="id_eleve" required>
                <option value="">— Sélectionner —</option>
                <?php foreach ($eleves as $eleve): ?>
                  <option value="<?= esc($eleve['id_eleve']) ?>"><?= esc($eleve['etu']) ?> : <?= esc($eleve['nom']) ?> <?= esc($eleve['prenom']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div>
              <label class="field-label">Semestre <span class="required">*</span></label>
              <select name="id_semestre" required>
                <option value="">— Sélectionner —</option>
                <?php foreach ($semestres as $semestre): ?>
                  <option value="<?= esc($semestre['id_semestre']) ?>"><?= esc($semestre['semestre']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div>
              <label class="field-label">Matiere <span class="required">*</span></label>
              <select name="id_matiere" required>
                <option value="">— Sélectionner —</option>
                <?php foreach ($matieres as $matiere): ?>
                  <option value="<?= esc($matiere['id_matiere']) ?>"><?= esc($matiere['ue']) ?> : <?= esc($matiere['intitule']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div>
              <label class="field-label">Note <span class="required">*</span></label>
              <input type="number" name="note" value="10" min="0" max="20" step="0.5" required />
            </div>
            <div>
              <label class="field-label">&nbsp;</label>
              <button type="submit" class="btn btn-primary">Ajouter la note</button>
            </div>
          </div>
        </div>

      </form>

      <div class="table-card">
        <h3 style="margin-bottom:16px">Liste des notes enregistrées</h3>
        <table>
          <thead>
            <tr>
              <th class="sortable">Élève</th>
              <th class="sortable">Semestre</th>
              <th class="sortable">Matière</th>
              <th class="sortable">Note /20</th>
              <th class="sortable">Résultat</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($notes)): ?>
              <?php foreach ($notes as $note): ?>
                <tr>
                  <td>
                    <div style="font-weight:600"><?= esc($note['nom'] ?? '') ?> <?= esc($note['prenom'] ?? '') ?></div>
                    <div style="font-size:11px;color:var(--c-muted)"><?= esc($note['etu'] ?? '') ?></div>
                  </td>
                  <td><?= esc($note['semestre'] ?? '') ?></td>
                  <td>
                    <div style="font-weight:600"><?= esc($note['ue'] ?? '') ?></div>
                    <div style="font-size:11px;color:var(--c-muted)"><?= esc($note['intitule'] ?? '') ?></div>
                  </td>
                  <td style="font-weight:600;text-align:center"><?= esc($note['note'] ?? '') ?></td>
                  <td>
                    <?php if ($note['resultat'] === 'Validé'): ?>
                      <span class="badge badge-green"><?= esc($note['resultat']) ?></span>
                    <?php else: ?>
                      <span class="badge badge-red"><?= esc($note['resultat']) ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="td-actions">
                      <button class="action-btn" title="Modifier">
                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                      </button>
                      <button class="action-btn del" title="Supprimer">
                        <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" style="text-align:center;padding:24px;color:var(--c-muted);font-style:italic">Aucune note enregistrée.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /app -->

<script src="script.js"></script>
</body>
</html>
