<h4><?= $lang['results'] ?></h4>
<div data-aos="flip-down" data-aos-delay="5000">
  <? switch($dataSet[$i]['Hurray']) {
    case 'Hurray':
      echo "<span class=\"mb-2 d-block btn btn-success\">{$lang['hurray']}</span>";
    break;
    case 'SCF':
      echo "<span class=\"mb-2 d-block btn btn-warning\">{$lang['scf_convergence']}</span>";
    break;
    case 'Error':
      echo "<span class=\"mb-2 d-block btn btn-danger\">{$lang['no_convergence']}</span>";
    break;
    default:
      echo "<span class=\"mb-2 d-block btn btn-success\">{$lang['no_convergence']}</span>";
    break;
  } ?>
</div>

<div data-aos="flip-down" data-aos-delay="5000">
  <? switch($dataSet[$i]['Positive vibrational frequencies']) {
    case TRUE:
      echo "<a href=\"#vibrational-frequencies-{$i}\" class=\"mb-4 d-block btn btn-success\">{$lang['vibrational_frequencies']}: {$lang['positive']}</a>";
    break;
    case FALSE:
      echo "<a href=\"#vibrational-frequencies-{$i}\" class=\"mb-4 d-block btn btn-danger\">{$lang['vibrational_frequencies']}: {$lang['imaginary']}</a>";
    break;
    case NULL:
      echo "<a href=\"#vibrational-frequencies-{$i}\" class=\"mb-4 d-block btn btn-danger\">{$lang['vibrational_frequencies']}: {$lang['imaginary']}</a>";
    break;
  } ?>
</div>
