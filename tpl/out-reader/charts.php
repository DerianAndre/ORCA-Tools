<script>
  var ctx = document.getElementById('chart-oe-<?= $i ?>').getContext('2d');
  var orbitalEnergiesChart = new Chart(ctx, {
      type: 'line',
      <? if($dataSet[$i]['Orbital energies']['Spin'] == FALSE) { ?>
      data: {
        labels: [<? $c = count($dataSet[$i]['Orbital energies'])-1; for($j = 0; $j < $c; $j++) { echo $dataSet[$i]['Orbital energies'][$j]['#']; if($j < $c) echo ', '; } ?>],
        datasets: [{
          label: '<?= $lang['orbital_energy'] ?>',
          fill: true,
          backgroundColor: 'rgba(54, 162, 235, .5)',
          borderColor: 'rgba(54, 162, 235, .5)',
          data: [<? for($j = 0; $j < $c; $j++) { echo $dataSet[$i]['Orbital energies'][$j]['Energy (eV)']; if($j < $c) echo ', '; } ?>]
        }]
      },
      <? } else { ?>
      data: {
        labels: [<? for($j = 0; $j < $c/2; $j++) { echo $dataSet[$i]['Orbital energies'][$j]['#']; if($j < $c) echo ', '; } ?>],
        datasets: [{
          label: 'Spin Up',
          fill: true,
          backgroundColor: 'rgba(54, 162, 235, .35)',
          borderColor: 'rgba(54, 162, 235, .5)',
          data: [<? for($j = 0; $j < $c/2; $j++) { echo $dataSet[$i]['Orbital energies'][$j]['Energy (eV)']; if($j < $c) echo ', '; } ?>]
        }, {
          label: 'Spin Down',
          fill: true,
          backgroundColor: 'rgba(255, 99, 132, .35)',
          borderColor: 'rgba(255, 99, 132, .5)',
          data: [<? for($j = $c/2; $j < $c; $j++) { echo $dataSet[$i]['Orbital energies'][$j]['Energy (eV)']; if($j < $c) echo ', '; } ?>]
        }]
      },
      <? } ?>
      options: {
        responsive: true,
        title: {
          display: false,
          text: '<?= $lang['orbital_energy'] ?>'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: '#'
            },
            ticks: {
              stepSize: 20
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: '<?= $lang['orbital_energy'] ?> (eV)'
            }
          }]
        }
      }
    }
  );
</script>
<script>
  var ctx = document.getElementById('chart-vf-<?= $i ?>').getContext('2d');
  var vibrationalFrequenciesChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [<? $c = count($dataSet[$i]['Vibrational frequencies'])-1; for($j = 0; $j < $c; $j++) { echo $j; if($j < $c) echo ', '; } ?>],
        datasets: [{
          label: '<?= $lang['vibrational_frequency'] ?>',
          fill: true,
          backgroundColor: 'rgba(75, 192, 192, .36)',
          borderColor: 'rgba(75, 192, 192, 1)',
          data: [<? for($j = 0; $j < $c; $j++) { echo $dataSet[$i]['Vibrational frequencies'][$j]; if($j < $c) echo ', '; } ?>]
        }]
      },

      options: {
        responsive: true,
        title: {
          display: false,
          text: '<?= $lang['vibrational_frequency'] ?>'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: '#'
            },
            ticks: {
              stepSize: 20
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: '<?= $lang['frequency'] ?> (cm^-1)'
            }
          }]
        }
      }
    }
  );
</script>
