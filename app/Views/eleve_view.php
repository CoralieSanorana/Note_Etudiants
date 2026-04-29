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

        <!-- Relevé de notes -->
        <?php if (!empty($transcript)): ?>
          <div style="margin-top:32px">
            <h3>Relevé de notes</h3>
            <?php foreach ($transcript as $semestreData): ?>
              <div class="table-card" style="margin-top:24px">
                <h4 style="margin-bottom:16px;color:var(--c-primary)"><?= esc($semestreData['semestre']) ?></h4>
                <?php if ($semestreData['option_flag'] == 0): ?>
                  <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:16px">
                    <span class="badge badge-green">Moyenne: <?= esc($semestreData['moyenne']) ?></span>
                    <?php if ($semestreData['resultat'] === 'Validé'): ?>
                      <span class="badge badge-green"><?= esc($semestreData['resultat']) ?></span>
                    <?php elseif ($semestreData['resultat'] === 'Échoué'): ?>
                      <span class="badge badge-red"><?= esc($semestreData['resultat']) ?></span>
                    <?php else: ?>
                      <span style="color:var(--c-muted)">N/A</span>
                    <?php endif; ?>
                    <span style="color:var(--c-muted)">Crédits total: <?= esc($semestreData['totalCredits']) ?></span>
                  </div>
                <?php endif; ?>
                
                <?php foreach ($semestreData['options'] as $optionData): ?>
                  <?php if ($semestreData['option_flag'] == 1 && !empty($optionData['name'])): ?>
                    <div style="font-weight:600;margin-top:12px;margin-bottom:8px">Option: <?= esc($optionData['name']) ?></div>
                  <?php elseif ($semestreData['option_flag'] == 0 && !empty($optionData['name'])): ?>
                    <div style="font-weight:600;margin-top:12px;margin-bottom:8px"><?= esc($optionData['name']) ?></div>
                  <?php endif; ?>
                  
                  <table style="width:100%;margin-bottom:16px;border-collapse:collapse">
                    <thead>
                      <tr style="background:var(--c-surface)">
                        <th style="text-align:left;padding:8px;border:1px solid var(--c-border)">UE</th>
                        <th style="text-align:left;padding:8px;border:1px solid var(--c-border)">Intitulé</th>
                        <th style="text-align:center;padding:8px;width:80px;border:1px solid var(--c-border)">Crédits</th>
                        <th style="text-align:center;padding:8px;width:80px;border:1px solid var(--c-border)">Note/20</th>
                        <th style="text-align:center;padding:8px;width:100px;border:1px solid var(--c-border)">Résultat</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($optionData['matieres'] as $matiere): ?>
                        <tr>
                          <td style="padding:8px;font-weight:600;border:1px solid var(--c-border)"><?= esc($matiere['ue']) ?></td>
                          <td style="padding:8px;border:1px solid var(--c-border)"><?= esc($matiere['intitule']) ?></td>
                          <td style="padding:8px;text-align:center;border:1px solid var(--c-border)"><?= esc($matiere['credit']) ?></td>
                          <td style="padding:8px;text-align:center;font-weight:600;border:1px solid var(--c-border)"><?= esc($matiere['note'] ?? 0) ?></td>
                          <td style="padding:8px;text-align:center;border:1px solid var(--c-border)">
                            <?php if ($matiere['resultat'] === 'Validé'): ?>
                              <span class="badge badge-green"><?= esc($matiere['resultat']) ?></span>
                            <?php elseif ($matiere['resultat'] === 'N/A'): ?>
                              <span style="color:var(--c-muted)">N/A</span>
                            <?php else: ?>
                              <span class="badge badge-red"><?= esc($matiere['resultat']) ?></span>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <tr style="font-weight:600;background:var(--c-surface)">
                        <td colspan="2" style="padding:12px;text-align:right;border:1px solid var(--c-border)">Synthèse:</td>
                        <td style="padding:12px;text-align:center;border:1px solid var(--c-border)">Crédits: <?= esc($optionData['totalCredits']) ?></td>
                        <td style="padding:12px;text-align:center;border:1px solid var(--c-border)">Moyenne: <?= esc($optionData['moyenne']) ?></td>
                        <td style="padding:12px;text-align:center;border:1px solid var(--c-border)">
                          <?php if ($optionData['resultat'] === 'Validé'): ?>
                            <span class="badge badge-green"><?= esc($optionData['resultat']) ?></span>
                          <?php elseif ($optionData['resultat'] === 'Échoué'): ?>
                            <span class="badge badge-red"><?= esc($optionData['resultat']) ?></span>
                          <?php else: ?>
                            <span style="color:var(--c-muted)">N/A</span>
                          <?php endif; ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
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
