<?php

/**
 * @file
 * Example tpl file for theming a single league_game-specific theme
 *
 * Available variables:
 * - $status: The variable to theme (while only show if you tick status)
 * 
 * Helper variables:
 * - $league_game: The LeagueGame object this status is derived from
 */
?>

<div class="league_game-body league_game-body-<?php print $view_mode ?>">
  <?php if ($view_mode == 'teaser'): ?>
  <p><span class="team_a"><?php print $team_a ?></span>&nbsp;-&nbsp;<span class="team_b"><?php print $team_b ?></span></p>
  <?php else: ?>
  <table>
    <thead>
      <th><?php print $team_a ?></th>
      <th><?php print $team_b ?></th>
    </thead>
    <tr>
      <td><span class="band-left"> <?php print $emblem_a ?></span><span class="score-<?php print $score_a ?>"><?php print $score_a ?></span></td>
      <td><span class="score-<?php print $score_b ?>"><?php print $score_b ?></span><span class="band-right"><?php print $emblem_b ?></span></td>
    </tr>
  </table> 
  <?php endif; ?>
</div>
