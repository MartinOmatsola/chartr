<?php
require_once 'chartr.php';


$arrParams['css_style'] = array('width' => '400px', 'height' => '200px', 'border' => '1px solid #CCCCCC', 
								'font-family' => 'Trebuchet MS', 'background-color' => '#EEEEEE');
$arrParams['data'] = array(
 							array('label' => 'Basketball', 'percentage' => '35', 'color' => '#36393D'),
 							array('label' => 'Football', 'percentage' => '55', 'color' => '#CDEB8B'),
 							array('label' => 'Hockey', 'percentage' => '10') //random color will be generated
 						);
 
$orientation = 0;

echo '<center>';

echo renderHistogram($arrParams, $orientation);

echo '<br/>';

echo renderHistogram($arrParams, 1);

echo '</center>';

?>
