<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 * @credits     Check credits.html included in this package or repository for a full list of credits
 */


defined('JPATH_BASE') or die;

// init
$options = $displayData;
$cols = $options["cols"];
if(is_array($cols)){
	$ncols = count($cols);
}
else{
	$ncols = $cols;
}
if($ncols < 1 || $ncols > 12) throw new Exception('invalid parameter');
$elements = $options["elements"]; if(!$ncols) throw new Exception('invalid parameter');
$cont_cols = 0;
?>
<?php foreach ($elements as $element) : ?>
	<?php $n++; ?>
	<?php if($n == 1) : ?>
		<div class="row-fluid">
	<?php endif; ?>

	<?php
	if(is_array($cols)){
		//Explicit mode
		$span=$cols[$cont_cols];
			if($cont_cols<$ncols-1){
				$cont_cols++;
			}
			else{
				$cont_cols=0;
			}
	}
	else{
		//Simple mode
		switch($ncols){
			case 1:
				$span = "span".(12);
				break;

			case 2:
				$span = "span".(6);
				break;

			case 3:
				$span = "span".(4);
				break;

			case 4:
				$span = "span".(3);
				break;

			case 5:

				if($cont_cols <4){
					$span = "span".(2);
				}
				else{
					$span = "span".(4);
				}
				break;

			case 6:
				$span = "span".(2);
				break;

			case 7:
				if($cont_cols <= 1){
					$span = "span".(1);
				}
				else{
					$span = "span".(2);
				}
				break;

			case 8:
				if($cont_cols <= 3){
					$span = "span".(1);
				}
				else{
					$span = "span".(2);
				}

				break;

			case 9:
				if($cont_cols <= 5){
					$span = "span".(1);
				}
				else{
					$span = "span".(2);
				}
				break;

			case 10:
				if($cont_cols <= 8){
					$span = "span".(1);
				}
				else{
					$span = "span".(3);
				}
				break;

			case 11:
				if($cont_cols <= 9){
					$span = "span".(1);
				}
				else{
					$span = "span".(2);
				}
				break;

			case 12:
				$span = "span".(1);
				break;
		}
			if($cont_cols<$ncols-1){
				$cont_cols++;
			}
			else{
				$cont_cols=0;
			}
	}
	?>

	<div class="<?php echo $span; ?>">
		<strong><?php echo $element["title"];?></strong>
		<?php echo $element["content"]; ?>
	</div>

	<?php if($n == $ncols) : ?>
		</div>
		<?php $n = 0; ?>
	<?php endif; ?>
<?php endforeach; ?>
