<?php

use app\models\Persons;
use app\models\Events;
use app\models\Results;

if ($person == null):
  $this->title = Yii::t('app', 'WCA Profile - Person Not Found');
?>
<h1 class="text-center">404</h1>
<?php
else:
  $this->title = Yii::t('app', 'WCA Profile - ') . $person[0]['name'];
?>
<h1 class="text-center"><?= $person[0]['name']; ?></h1>
<section class="clearfix">
  <div class="col-md-8 col-md-offset-2 table-responsive">
    <table class="table table-condensed" id="personalDetails">
      <thead>
        <tr class="info">
          <th><?= Yii::t('app', 'WCA ID') ?></th>
          <th><?= Yii::t('app', 'Name') ?></th>
          <th><?= Yii::t('app', 'Country') ?></th>
          <th><?= Yii::t('app', 'Gender') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php for ($i = 0, $count = count($person); $i < $count; $i++): ?>
        <tr <?= $i > 0 ? 'class="text-muted"' : '' ?>>
          <td><?php if ($i == 0): ?>
            <a target="_blank" href="https://www.worldcubeassociation.org/results/p.php?i=<?= $person[$i]['id'] ?>">
              <img src="/img/WCAlogo_notext.svg" class="wca-logo" title="WCA" alt="WCA"><?= $person[$i]['id'] ?>
            </a>
          <?php else: ?>
            <em><?=Yii::t('app', '(was)') ?></em>
          <?php endif; ?></td>
          <td><?= $person[$i]['name'] ?></td>
          <td>
            <a href="/kinch/countries#<?= $person[$i]['countryId'] ?>">
              <?= Yii::t('region', $person[$i]['country']) ?>
            </a>
          </td>
          <td><?= Yii::t('app', Persons::getGenderName($person[$i]['gender'])) ?></td>
        </tr>
      <?php endfor; ?>
      </tbody>
    </table>
  </div>
</section>
<section class="clearfix">
  <div class="col-md-8 col-md-offset-2 table-responsive">
    <table class="table table-condensed">
      <thead>
        <tr class="info">
          <th class="text-center"><?= Yii::t('app', 'Event') ?></th>
          <th class="text-right">NR</th>
          <th class="text-right">CR</th>
          <th class="text-right">WR</th>
          <th class="text-right"><?= Yii::t('app', 'Best') ?></th>
          <th class="text-right"><?= Yii::t('app', 'Average') ?></th>
          <th class="text-right">WR</th>
          <th class="text-right">CR</th>
          <th class="text-right">NR</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pbs as $event): ?>
        <tr>
          <th class="text-center"><?= Yii::t('event', Events::getCellName($event['s']['eventId'])) ?></th>
          <td class="text-right"><?= $event['s']['countryRank'] ?></td>
          <td class="text-right"><?= $event['s']['continentRank'] ?></td>
          <td class="text-right"><?= $event['s']['worldRank'] ?></td>
          <td class="text-right"><?= Results::formatTime($event['s']['best'], $event['s']['eventId']) ?></td>
          <td class="text-right"><?= isset($event['a']) ? Results::formatTime($event['a']['best'], $event['a']['eventId']) : '' ?></td>
          <td class="text-right"><?= isset($event['a']) ? $event['a']['worldRank'] : '' ?></td>
          <td class="text-right"><?= isset($event['a']) ? $event['a']['continentRank'] : '' ?></td>
          <td class="text-right"><?= isset($event['a']) ? $event['a']['countryRank'] : '' ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
<section class="clearfix">
  <h3 class="text-center"><?= Yii::t('app', 'Oldest Standing Personal Records') ?></h3>
  <div class="col-md-8 col-md-offset-2 table-responsive">
    <table class="table table-condensed table-striped table-bordered">
      <thead>
        <tr class="info">
          <th class="text-center"><?= Yii::t('app', 'Event') ?></th>
          <th class="text-right"><?= Yii::t('app', 'Best') ?></th>
          <th class="text-right"><?= Yii::t('app', 'Average') ?></th>
          <th class="text-center"><?= Yii::t('app', 'Days') ?></th>
          <th class=""><?= Yii::t('app', 'Competition') ?></th>
          <th class=""><?= Yii::t('app', 'Date') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($oprs as $opr): ?>
        <tr>
          <th class="text-center"><?= Yii::t('event', Events::getCellName($opr['eventId'])) ?></th>
          <td class="text-right"><?= Results::formatTime($opr['best'], $opr['eventId']) ?></td>
          <td class="text-right"><?= Results::formatTime($opr['average'], $opr['eventId']) ?></td>
          <td class="text-center"><?= $opr['days'] ?></td>
          <td><a href="https://www.worldcubeassociation.org/results/c.php?i=<?= $opr['competitionId'] ?>" target="_blank"><?= $opr['competitionName'] ?></a></td>
          <td><?= Yii::$app->formatter->asDate(mktime(0, 0, 0, $opr['month'], $opr['day'], $opr['year']), 'medium') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    </table>
  </div>
</section>
<?php
endif;
?>