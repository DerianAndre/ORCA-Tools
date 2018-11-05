<?
ini_set('memory_limit', -1);

//
//  Debug: Display errors
//
function displayErrors() {
  if(DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  } else {
    error_reporting(0);
  }
}

//
//  Delete Temp Files
//
function deleteTmpFiles() {
  $files = glob('tmp/*');
  foreach($files as $file) {
    if(is_file($file))
      unlink($file);
  }
}

//
//  File error message
//
function fileError($msg, $page) {
  global $lang;
  $content = "<div class=\"page-full d-sm-flex justify-content-center align-items-center\">";
  $content .= "<div class=\"col-2 p-3 text-center\">";
  $content .= "<h2>{$lang['error']}</h2>";
  $content .= "<p>{$msg}</p>";
  $content .= "<a href=\"{$page}.php\" class=\"btn btn-success\">{$lang['go_back']}</a>";
  $content .= "</div>";
  $content .= "</div>";
  return $content;
}

//
//  Temp .XYZ file
//
function tempXYZ($i, $data) {
  $tmpDir = 'tmp';
  $tmpFileName = $tmpDir . '/cc-' . $data['File name'] . '-' . $i . '.txt';
  $tmpFileContent = $data['Number of atoms'] . "\r\n" . $data['File name'] . "\r\n" . implodeFinalGeometry($data['Geometry']['Final']['Cartesian']['Angstroem']);
  $tmpFile = new SplFileObject($tmpFileName, 'w');
  $tmpFile->fwrite($tmpFileContent);
  return 'tmp/cc-' . $data['File name'] . '-' . $i . '.txt';
}

//
// Implode Final Geometry
//
function implodeFinalGeometry($array) {
  $implode = '';
  foreach($array as $element) {
    $implode .= implode(" ", $element) . "\r\n";
  }
  return $implode;
}

//
//  Array: File Info
//
function arrayInfo($file_name) {
  $arrayInfo = array();
  $regx = '/[a-z0-9\-]+/i';
  if(preg_match_all($regx, $file_name, $match)) {
    $arrayInfo['Molecule name'] = $match[0][0];
    if(count($match[0]) > 1) {
      $arrayInfo['Molecule added'] = $match[0][1];
    } else {
      $arrayInfo['Molecule added'] = false;
    }
    if(isset($arrayInfo['Molecule added'])) {
      $regx = '/([0-9])(.*)/i';
      if(preg_match($regx, $arrayInfo['Molecule added'], $match)) {
        $arrayInfo['Molecule added atoms'] = intval($match[1]);
        $arrayInfo['Molecule added'] = $match[2];
      } else {
        $arrayInfo['Molecule added atoms'] = FALSE;
        $arrayInfo['Molecule added'] = FALSE;
      }
    }
  } else {
    $arrayInfo['Molecule name'] = FALSE;
    $arrayInfo['Molecule added'] = FALSE;
    $arrayInfo['Molecule added atoms'] = FALSE;
  }
  return $arrayInfo;
}

//
//  Total Charge
//
function totalCharge($source) {
  $regx = '/Total Charge.*?(\d+)/';
  if(preg_match($regx, $source, $match)) {
    return intval($match[1]);
  } else {
    return FALSE;
  }
}

//
//  Multiplicity
//
function multiplicity($source) {
  $regx = '/Multiplicity.*?(\d+)/';
  if(preg_match($regx, $source, $match)) {
    return intval($match[1]);
  } else {
    return FALSE;
  }
}

//
//  ORCA Version
//
function orcaVersion($source) {
  $regx = "'Program Version (.*?) - 'si";
  if(preg_match($regx, $source, $match)) {
    return $match[1];
  } else {
    return FALSE;
  }
}

//
//  ORCA Input
//
function orcaInput($source) {
  $regx = '/^\|\s*\d*.....(.*)$/m';
  if(preg_match_all($regx, $source, $match, PREG_PATTERN_ORDER)) {
    array_pop($match[1]);
    return implode("\n", $match[1]);
  } else {
    return FALSE;
  }
}

//
//  Info & Warnings
//
function arrayInfoWarnings($source) {
  $array = array();
  $regx = '/WARNINGS(.*?)================================================================================..(.*?).INFO.....(.*?).================================================================================/s';
  if(preg_match($regx, $source, $match)) {
    $array['Warnings'] = trim(preg_replace('/\s\s+/', "\n", $match[2]));
    $array['Information'] = trim(preg_replace('/\s+/', ' ', $match[3]));
    if(!isset($array['Warnings'])) $array['Warnings'] = FALSE;
    if(!isset($array['Information'])) $array['Information'] = FALSE;
  } else {
    $array['Warnings'] = FALSE;
    $array['Information'] = FALSE;
  }
  return $array;
}

//
//  Geometry: Initial Coordinates
//
function geometryCartesianCoordinates($source, $scf = FALSE) {
  $array = array();
  $regx = '/CARTESIAN COORDINATES.(.*?).---------------------------------...(.*?).----------------------------.(.*?).----------------------------.......................................................................(.*?).--------------------------------.(.*?).--------------------------------..(.*?).---------------------------.(.*?).---------------------------..(.*?).---------------------/s';
  if(!$scf && preg_match($regx, $source, $match)) {
    $array['CC-AG'] = $match[2];
    $array['CC-AU'] = $match[4];
    $array['IC-AG'] = $match[6];
    $array['IC-AU'] = $match[8];
    return $array;
  } elseif($scf) {
    if(preg_match_all($regx, $source, $match)) {
      $array['CC-AG'] = end($match[2]);
      $array['CC-AU'] = end($match[4]);
      $array['IC-AG'] = end($match[6]);
      $array['IC-AU'] = end($match[8]);
      return $array;
    } else {
      return FALSE;
    }
  } else {
    return FALSE;
  }
}

//
//  Geometry: Redundant Internal Coordinates
//
function geometryRedundantInitialCoordinates($source) {
  $regx = '/Redundant Internal Coordinates..(.*?)(.*?)(.*?).(.*?)\*/s';
  if(preg_match($regx, $source, $match)) {
    $RIC[$i] = TRUE;
    $source2[$i] = $match[0];
    $regx = '/-----------------------------------------------------------------..(.*?).....-----------------------------------------------------------------..(.*?).........-----------------------------------------------------------------.................................................([0-9])...............................................([0-9])./s';
    if(preg_match($regx, $source2[$i], $match)) {
      $table_head[$i] = $match[1];
      $table[$i] = $match[2];
    } else {
      $table_head[$i] = 'N/A';
      $table[$i] = 'N/A';
    }
  } else {
    return FALSE;
  }
}

//  Number of Atoms
//
function numberOfAtoms($source) {
  $regx = '/Number of atoms.*?(\d+)/s';
  if(preg_match($regx, $source, $match)) {
    return intval($match[1]);
  } else {
    return FALSE;
  }
}

//
//  Number of Degrees of Freedom
//
function numberDoF($source) {
  $regx = '/Number of degrees of freedom.*?(\d+)/s';
  if(preg_match($regx, $source, $match)) {
    return intval($match[1]);
  } else {
    return FALSE;
  }
}

//
//  HURRAY
//
function hurray($source) {
  global $lang;
  $array = array();
  if(preg_match('/HURRAY/si', $source, $match)) {
    $array['Error'] = FALSE;
    $array['Hurray'] = 'Hurray';
  } else {
    $regx = '/SUCCESS....................................................(.*?)..........\*/s';
    if(preg_match($regx, $source, $match)) {
      $array['Error'] = FALSE;
      $array['Hurray'] = 'SCF';
    } else {
      $array['Error'] = TRUE;
      $array['Hurray'] = 'Error';
    }
  }
  return $array;
}

//
// GET ONLY POST-HURRAY CONTENT
//
function postHurray($source) {
  if(preg_match('/HURRAY(.*?).*$/s', $source, $match)) {
    return $match[0];
  } else {
    return FALSE;
  }
}

//
//  Total Energy
//
function totalEnergy($source) {
  $array = array();
  $regx = '/Total Energy........(.*?).Eh..(.*?).eV/s';
  if(preg_match($regx, $source, $match)) {
    $array['Eh'] = floatval($match[1]);
    $array['eV'] = floatval($match[2]);
  } else {
    $array['Eh'] = FALSE;
    $array['eV'] = FALSE;
  }
  return $array;
}

//
//  Orbital Energies
//
function orbitalEnergies($source) {
  $regx = '/ORBITAL ENERGIES..--------------......(.*?).\*/s';
  if(preg_match($regx, $source, $match)) {
    return $match[1];
  } else {
    return FALSE;
  }
}

// DFT DISPERSION CORRECTION
function DFT_DispersionCorrection($source) {
  //$regx = '/DFT DISPERSION CORRECTION(.*?)\*\*\* OPTIMIZATION RUN DONE/s';
  $regx = '/Dispersion correction(.*?)-------------------------/s';
  if(preg_match_all($regx, $source, $match)) {
    $regx = '/(-+[0-9]*\.[0-9]+|[0-9]+)/';
    if(preg_match($regx, end($match[1]), $match)) {
      return floatval($match[1]);
    }
  } else {
    return FALSE;
  }
}

//
//  Final Single Point Energy
//
function FSPEnergy($source, $type = 'Eh') {
  $Eh = 27.2113834;
  #$Eh = 27.2113961317875;
  $regx = '/FINAL SINGLE POINT ENERGY(.*?)-------------------------/s';
  if(preg_match_all($regx, $source, $match)) {
    $regx = '/(-+[0-9]*\.[0-9]+|[0-9]+)/';
    if(preg_match($regx, end($match[1]), $match)) {
      if($type == 'Eh') {
        return floatval($match[0]);
      } elseif($type == 'eV') {
        return floatval($match[0])*$Eh;
      }
    } else {
      return FALSE;
    }
  } else {
    return FALSE;
  }
}

//
//  Array Coordinates
//
function arrayCoordinates($source, $type = 'CC-AG', $numeric = FALSE) {
  $regx = '/([A-z-0-9.]+)/';
  $array = array();
  preg_match_all($regx, $source, $match);
  if($type == 'CC-AG') {
    for($j = 0; $j < count($match[0]) - 3; $j++) {
      if($numeric == FALSE) {
        $array[] = array(
          'Element' => $match[0][$j],
          'x' => $match[0][$j+1],
          'y' => $match[0][$j+2],
          'z' => $match[0][$j+3]
        );
      } else {
        $array[] = array(
          'Element' => $match[0][$j],
          'x' => floatval($match[0][$j+1]),
          'y' => floatval($match[0][$j+2]),
          'z' => floatval($match[0][$j+3])
        );
      }
      $j = $j+3;
    }
  } elseif($type == 'CC-AU') {
    for($k = 0, $j = 0; $j < count($match[0]) - 6; $k++, $j+=8) {
      if($numeric == FALSE) {
        $array[] = array(
          '#' => $k,
          'LB' => $match[0][$j],
          'ZA' => $match[0][$j+1],
          'Frag' => $match[0][$j+2],
          'Mass' =>  $match[0][$j+3],
          'x' => $match[0][$j+4],
          'y' => $match[0][$j+5],
          'z' => $match[0][$j+6]
        );
      } else {
        $array[] = array(
          '#' => intval($k),
          'LB' => $match[0][$j],
          'ZA' => floatval($match[0][$j+1]),
          'Frag' => intval($match[0][$j+2]),
          'Mass' => floatval($match[0][$j+3]),
          'x' => floatval($match[0][$j+4]),
          'y' => floatval($match[0][$j+5]),
          'z' => floatval($match[0][$j+6])
        );
      }
    }
  } elseif($type == 'IC') {
    for($j = 0; $j < count($match[0]) - 6; $j++) {
      if($numeric == FALSE) {
        $array[] = array(
          'Element' => $match[0][$j],
          'i' => $match[0][$j+1],
          'j' => $match[0][$j+2],
          'k' => $match[0][$j+3],
          'x' => $match[0][$j+4],
          'y' => $match[0][$j+5],
          'z' => $match[0][$j+6]
        );
      } else {
        $array[] = array(
          'Element' => $match[0][$j],
          'i' => intval($match[0][$j+1]),
          'j' => intval($match[0][$j+2]),
          'k' => intval($match[0][$j+3]),
          'x' => floatval($match[0][$j+4]),
          'y' => floatval($match[0][$j+5]),
          'z' => floatval($match[0][$j+6])
        );
      }
      $j = $j+6;
    }
  }
  return $array;
}

//
//  ORBITAL ENERGIES
//
function arrayOrbitalEnergies($source) {
  if(!empty($source)) {
    if(preg_match('/SPIN/', $source)) {
      $spin = TRUE;
    } else {
      $spin = FALSE;
    }

    $regx = '/([-0-9.]+)/';
    preg_match_all($regx, $source, $match, PREG_SET_ORDER, 0);
    $table_size = count($match);
    $half = $table_size/2;
    $h = $half;

    $vars = array();
    $up = [];
    $down = [];

    if($spin == FALSE) {
      $s = array('Spin' => FALSE);
      for($i = 0; $i < $table_size;) {
        $array[] =
          array(
            '#' => intval($match[$i][0]),
            'OCC' =>  floatval($match[$i+1][0]),
            'Energy (Eh)' => floatval($match[$i+2][0]),
            'Energy (eV)' => floatval($match[$i+3][0])
          );
          $i = $i+4;
      }
      $array = array_merge($s, $array);
    } else {
      $s = array('Spin' => TRUE);
      for($i = 0; $i < $half*2;) {
        $up[] =
          array(
            '#' => intval($match[$i][0]),
            'OCC' =>  floatval($match[$i+1][0]),
            'Energy (Eh)' => floatval($match[$i+2][0]),
            'Energy (eV)' => floatval($match[$i+3][0])
          );
          $i = $i+4;
      }
      for($half; $half < $table_size/4;) {
        $down[] =
          array(
            '#' => intval($match[$i][0]),
            'OCC' =>  floatval($match[$i+1][0]),
            'Energy (Eh)' => floatval($match[$i+2][0]),
            'Energy (eV)' => floatval($match[$i+3][0])
          );
          $half = $half+4;
      }
      $array = array_merge($s, $up, $down);
    }
    return $array;
  } else {
    return FALSE;
  }
}

//
// HOMO & LUMO
//
function HOMO_LUMO($source) {
  if(!empty($source)) {
    $table_size = count($source)-2;
    $h = ($table_size/2);
    for($i = 0; $i < $table_size; $i++) {
      if($source['Spin'] == FALSE) {
        if($i < $table_size) {
          if($source[$i]['OCC'] > $source[$i+1]['OCC']) {
            $HOMO_alpha = $source[$i]['Energy (eV)'];
            $LUMO_alpha = $source[$i+1]['Energy (eV)'];
            $HOMO_beta = $HOMO_alpha;
            $LUMO_beta = $LUMO_alpha;
          }
        }
      } else {
        if($i < $table_size/2) {
          if($source[$i]['OCC'] > $source[$i+1]['OCC']) {
            $HOMO_alpha = $source[$i]['Energy (eV)'];
            $LUMO_alpha = $source[$i+1]['Energy (eV)'];
          }
        }
        if($i+$h < $table_size ) {
          if($source[$i+$h]['OCC'] > $source[$i+$h+1]['OCC']) {
            $HOMO_beta = $source[$i+$h]['Energy (eV)'];
            $LUMO_beta = $source[$i+$h+1]['Energy (eV)'];
          }
        }
      }
    }
    $HOMO = array('Alpha' => $HOMO_alpha, 'Beta' => $HOMO_beta);
    $LUMO = array('Alpha' => $LUMO_alpha, 'Beta' => $LUMO_beta);
    $HOMO = max($HOMO);
    $LUMO = min($LUMO);
    $HLGap = $LUMO - $HOMO;
    $array = array(
      'Gap' => $HLGap,
      'HOMO' => $HOMO,
      'LUMO' => $LUMO,
      'HOMO alpha' => $HOMO_alpha,
      'HOMO beta' => $HOMO_beta,
      'LUMO alpha' => $LUMO_alpha,
      'LUMO beta' => $LUMO_beta
    );
    return $array;
  } else {
    return FALSE;
  }
}


//
//  Vibrational frequencies
//
function vibrationalFrequencies($source) {
  $regx = '/VIBRATIONAL FREQUENCIES.(.*).NORMAL MODES/s';
  if(preg_match($regx, $source, $match)) {
    $regx = '/\s*\d*.\s*(.*)$/m';
    if(preg_match_all($regx, $match[1], $array)) {
      $array = array_slice($array[1], 1, -1);
      return $array;
    } else {
      return FALSE;
    }
  } else {
    return FALSE;
  }
}

//
// Array: Vibrational frequencies
//
function arrayVibrationalFrequencies($array) {
  if(!empty($array)) {
    $newArray = array();
    foreach($array as $line) {
      $num = floatval(substr($line, 0, -7));
      array_push($newArray, $num);
    }
    return $newArray;
  } else {
    return false;
  }
}

/**
 * Positive vibrational frequencies: Check if vibrational Frequencies are positives
 * @param array $array
 * @return bool
 */
function positiveVibrationalFequencies($array) {
  if(!empty($array)) {
    $error = 0;
    foreach($array as $line) {
      $num = floatval(substr($line, 0, -7));
      if($num < 0) {
        $error = 1;
      }
    }
    if($error == 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  } else {
    return null;
  }
}

/**
 * Obtain total run time
 * @param string $source
 * @return string
 */
function totalRunTime($source) {
  $regx = '/TOTAL RUN TIME: .(.*)./s';
  if(preg_match($regx, $source, $match)) {
    $regx = '/(\d+)/m';
    if(preg_match_all($regx, $match[0], $match, PREG_SET_ORDER)) {
      $array['Days'] = intval($match[0][0]);
      $array['Hours'] = intval($match[1][0]);
      $array['Minutes'] = intval($match[2][0]);
      $array['Seconds'] = intval($match[3][0]);
      $array['Miliseconds'] = intval($match[4][0]);
      return $array;
    } else {
      return FALSE;
    }
  } else {
    return FALSE;
  }
}

function runTimeReadable($runtime) {
  global $lang;
  if(!empty($runtime)) {
    foreach($runtime as $index => $value) {
      if($value > 0) {
        if($value == 1) {
          $type = substr($lang[strtolower($index)], 0, -1);
        } else {
          $type = $lang[strtolower($index)];
        }
        $runtime[$index] = "{$runtime[$index]} {$type}";
      } else {
        $runtime[$index] = false;
      }
    }

    return "{$runtime['Days']} {$runtime['Hours']} {$runtime['Minutes']} {$runtime['Seconds']} {$runtime['Miliseconds']}";
  } else {
    return FALSE;
  }
}

/**
 * Final Array: gives all the data from the .out file in an organized array
 * @param string $fileName
 * @param string $source
 * @return array $data
 */
function arrayOutData($fileName, $source) {
  if(!empty($fileName) && !empty($source)) {
    $postHurray = postHurray($source);
    // Arrays
    $arrayInfo = arrayInfo($fileName);
    $arrayIW = arrayInfoWarnings($source);
    $arrayHurray = hurray($source);

    $arrayGIC = geometryCartesianCoordinates($source);
    $arrayGFC = !empty(geometryCartesianCoordinates($postHurray)) ? geometryCartesianCoordinates($postHurray) : geometryCartesianCoordinates($source, TRUE);
    // Post Hurray
    $arrayTotalEnergy = totalEnergy($postHurray);
    // Final Array
    $data = array(
      "ORCA Tools version" => ORCAToolsVersion,
      "File name" => $fileName,
      "File RAW" => $source,
      "ORCA Version" => orcaVersion($source),
      "ORCA Information" => $arrayIW['Information'],
      "ORCA Warnings" => $arrayIW['Warnings'],
      "Molecule name" => $arrayInfo['Molecule name'],
      "Molecule added" => $arrayInfo['Molecule added'],
      "Molecule added atoms" => $arrayInfo['Molecule added atoms'],
      "Multiplicity type" => multiplicityType(multiplicity($source)),
      "VdW correction" => dispersionCorrectionType(orcaInput($source)),
      "Hurray" => $arrayHurray['Hurray'],
      "Hurray error" => $arrayHurray['Error'],
      "Input" => orcaInput($source),
      "Total energy" => array(
        "Eh" => $arrayTotalEnergy['Eh'],
        "eV" => $arrayTotalEnergy['eV']
      ),
      "Final Single Point Energy" => array(
        "Eh" => FSPEnergy($source),
        "eV" => FSPEnergy($source, 'eV')
      ),
      "Number of atoms" => numberOfAtoms($source),
      "Number of degrees of freedom" => numberDoF($source),
      "Charge" => totalCharge($source),
      "Dispersion correction" => DFT_DispersionCorrection($source),
      "Multiplicity" => multiplicity($source),
      "Orbital energies" => arrayOrbitalEnergies(orbitalEnergies($source)),
      "HOMO-LUMO" => HOMO_LUMO(arrayOrbitalEnergies(orbitalEnergies($source))),
      "Geometry" => array(
        "Initial" => array(
          "Cartesian" => array(
            "Angstroem" => arrayCoordinates($arrayGIC['CC-AG'], 'CC-AG'),
            "A.U." => arrayCoordinates($arrayGIC['CC-AU'], 'CC-AU')
          ),
          "Internal" => array(
            "Angstroem" => arrayCoordinates($arrayGIC['IC-AG'], 'IC'),
            "A.U." => arrayCoordinates($arrayGIC['IC-AU'], 'IC')
          )
        ),
        "Final" => array(
          "Cartesian" => array(
            "Angstroem" => arrayCoordinates($arrayGFC['CC-AG'], 'CC-AG'),
            "A.U." => arrayCoordinates($arrayGFC['CC-AU'], 'CC-AU')
          ),
          "Internal" => array(
            "Angstroem" => arrayCoordinates($arrayGFC['IC-AG'], 'IC'),
            "A.U." => arrayCoordinates($arrayGFC['IC-AU'], 'IC')
          )
        )
      ),
      "Vibrational frequencies" => arrayVibrationalFrequencies(vibrationalFrequencies($source)),
      "Positive vibrational frequencies" => positiveVibrationalFequencies(vibrationalFrequencies($source)),
      "Total run time" => totalRunTime($source)
    );


    return $data;
  } else {
    return FALSE;
  }
}

/**
 * Normalize Decimal
 * @param string $fileName
 * @param string $source
 * @return array $data
 */
function normalizeDecimal($val, int $precision = 8): string {
  $input = str_replace(' ', '', $val);
  $number = str_replace(',', '.', $input);
  if (strpos($number, '.')) {
    $groups = explode('.', str_replace(',', '.', $number));
    $lastGroup = array_pop($groups);
    $number = implode('', $groups) . '.' . $lastGroup;
  }
  return bcadd($number, 0, $precision);
}

function arrayExportJSON($array) {
  if(!empty($array)) {
    header('Content-Type: application/json');
    header("Content-Disposition: attachment; filename={$array['File name']}.json");
    header('Pragma: no-cache');
    return arrayTmpJSON($array);
  } else {
    return false;
  }
}

function arrayExportZIP($array) {
  $zipName = "{$array[0]['Molecule name']}.zip";
  $zip = new ZipArchive;
  $zip->open($zipName, ZipArchive::CREATE);
  for($id = 0; $id < count($array); $id++) {
    $zip->addFromString("{$array[$id]['File name']}.json", arrayTmpJSON($array[$id]));
  }
  $zip->close();
  header("Content-Type: application/zip");
  header("Content-disposition: attachment; filename={$zipName}");
  header('Content-Length: ' . filesize($zipName));
  header("Pragma: no-cache");
  readfile($zipName);
  unlink($zipName);
}

function arrayTmpJSON($array) {
  if(!empty($array)) {
    unset($array['File RAW']);
    return json_encode($array, JSON_PRETTY_PRINT);
  } else {
    return FALSE;
  }
}

function fileTitle($fileName) {
  $fileName = str_replace('_', ' ', $fileName);
  $fileName = preg_replace("/([a-z]+)(\d+)/i", "$1<sub>$2</sub>", $fileName);
  $fileName = preg_replace("/VDW(<sub>)(\d+)(<\/sub>)/i", "VDW$2", $fileName);
  return $fileName;
}

function dispersionCorrectionType($input) {
  $regx = '/\b(D|d2|D2)\b/s';
  $regx2 = '/\b(d3|D3)\b/s';
  if(preg_match($regx, $input, $match)) {
    return "VDW06";
  } elseif(preg_match($regx2, $input, $match)) {
    return "VDW10";
  } else {
    return "Normal";
  }
}

function tableClass($ods) {
  if($ods['Hurray'] == 'SCF') {
    echo 'table-warning';
  } elseif($ods['Hurray'] == 'Error') {
    echo 'table-danger';
  } else {
    echo 'table-normal';
  } if($ods['Positive vibrational frequencies'] == FALSE) {
    echo ' table-nvf';
  }
}

function multiplicityType($multiplicity) {
  global $lang;
  return $multiplicity >= 3 ? $lang['high'] : $lang['low'];
}

function tablePositiveVF($positiveVibrationalFrequencies) {
  global $lang;
  return $positiveVibrationalFrequencies == TRUE ? $lang['yes'] : $lang['no'];
}

function tableEnergy($ods) {
  return !empty($ods['Final Single Point Energy']['Eh']) ? $ods['Final Single Point Energy']['Eh'] : $ods['Total energy']['Eh'];
}

function tableGeometry($ods) {
  foreach($ods['Geometry']['Final']['Cartesian']['Angstroem'] as $ods_dato) {
    foreach($ods_dato as $index => $valor) {
      echo $valor . ' ';
    }
  }
}

function tableDispersionCorrection($dispersionCorrection) {
  return !empty($dispersionCorrection) ? $dispersionCorrection : '---------------';
}

function tableDelta($ods, $i) {
  if(!empty($ods[$i]['Final Single Point Energy']['Eh'])) {
    return ($ods[$i]['Final Single Point Energy']['Eh'] - $ods[$i-3]['Final Single Point Energy']['Eh'] + 1.164924471)*-27.211;
  } elseif(!empty($ods[$i]['Total energy']['Eh'])) {
    return ($ods[$i]['Total energy']['Eh'] - $ods[$i-3]['Total energy']['Eh'] + 1.164924471)*-27.211;
  } else {
    return 'N/A';
  }
}

function tableGap($gap) {
  return !empty($gap) ? $gap: 'N/A';
}

function chartGap($gap) {
  return !empty($gap) ? $gap: 0;
}

function tableVdwCorrection($vdwCorrection) {
  return $vdwCorrection == 'Normal' ? '---------------' : $vdwCorrection;
}
