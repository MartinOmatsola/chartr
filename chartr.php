<?php


/**
 * Returns html containing histogram
 * @param $arrParams is a dictionary containing histogram information in the format specified below
 * 
 *	$arrParams['css_style'] = array('width' => '400px', 'height' => '600px', 'border' => '1px solid #CCCCCC');
 *	$arrParams['data'] = array(
 *							array('label' => 'Basketball', 'percentage' => '35', 'color' => '#CFCFE7'),
 *							array('label' => 'Football', 'percentage' => '55', 'color' => '#44CFB7'),
 *							array('label' => 'Hockey', 'percentage' => '10') //random color will be generated
 *						);
 * @param $orientation 0 => horizontal, >0 => vertical
 */
function renderHistogram($arrParams, $orientation=0) {
	
	if (empty($arrParams['data'])) {
			die('No data supplied');
	}

	$style = getStyle($arrParams['css_style']);
	
	
	//if height is not specified, default bar height is 10px
	$barHeight = 20; 
	if (array_key_exists('height', $arrParams['css_style'])) {
		$height = substr($arrParams['css_style']['height'], 0, strlen($arrParams['css_style']['height']) - 2);
		$barHeight = round(($height - (0.33 * $height)) / count($arrParams['data']));
	}

	$width = 400;
	if (array_key_exists('width', $arrParams['css_style'])) {
		$width = substr($arrParams['css_style']['width'], 0, strlen($arrParams['css_style']['width']) - 2);
		//define border
		$barWidth = round(($width - (0.33 * $width))/ count($arrParams['data']));
	}
		
	$output =<<<END
	<div style="{$style}"><br/><center>
		<table>
END;
	
	
	if ($orientation) {
		
		$output .= '<tr>';
		
		for ($i = 0; $i < count($arrParams['data']); $i++) {

			$output.= '<td align="center">' . $arrParams['data'][$i]['percentage'] . '%</td>';

		}
		
		$output .= '</tr><tr>';

		for ($i = 0; $i < count($arrParams['data']); $i++) {
			
			$barHeight = round(($arrParams['data'][$i]['percentage']/100) * $height);
			$color = ($arrParams['data'][$i]['color']) ? $arrParams['data'][$i]['color'] : generateColor();		
			
			$output .=<<<END
			<td align="center" valign="bottom">
				<div style="width:{$barWidth}px;height:{$barHeight}px;background-color:{$color};border:1px solid #444444"></div>
			</td>
END;
		}

		$output .= '</tr><tr>';
		
		for ($i = 0; $i < count($arrParams['data']); $i++) {

			$output.= '<td align="center">' . $arrParams['data'][$i]['label'] . '</td>';

		}
		
		$output .= '</tr>';

	} else {

 		foreach ($arrParams['data'] as $item) {
		
			$barWidth = round(($item['percentage']/100) * $width);
			$color = ($item['color']) ? $item['color'] : generateColor();		

			$output .=<<<END
			<tr>
				<td align="right">{$item['label']}</td>
				<td align="left">
					<div style="width:{$barWidth}px;height:{$barHeight}px;background-color:{$color};border:1px solid #444444"></div>
				</td>
				<td>{$item['percentage']}%</td>
			</tr>
END;
		
		}
	}

	return $output . '</table></center><br /></div>';

}

/**
 * Returns a css style string
 * @param $css_style is a dictionary containing style info
 * eg css_style = ('width' => 400px, 'height' => 600px)
 */
function getStyle($css_style) {
	//create style attribute
	$style = '';
	foreach ($css_style as $k => $v) {
		$style .= sprintf("%s:%s;", $k, $v); 
	}
	return $style;
}
	
	
/**
 * Returns a random hex color
 */
function generateColor() {
	return sprintf('#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255));
}


?>
