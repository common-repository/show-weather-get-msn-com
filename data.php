<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 

if (!class_exists('simple_html_dom_node')) {
    include('simple_html_dom.php'); 
}

?>
<div class="wqn-thoitiet">
<div class="wqn-thoitiet-inner">
	<?php

	function wqn_get_current_weekday($ngayhientai) {
    $weekday = $ngayhientai;
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $weekday = 'Thứ hai';
            break;
        case 'tuesday':
            $weekday = 'Thứ ba';
            break;
        case 'wednesday':
            $weekday = 'Thứ tư';
            break;
        case 'thursday':
            $weekday = 'Thứ năm';
            break;
        case 'friday':
            $weekday = 'Thứ sáu';
            break;
        case 'saturday':
            $weekday = 'Thứ bảy';
            break;
        default:
            $weekday = 'Chủ nhật';
            break;
    	}
    	return $weekday ;
	}

	//echo wqn_get_current_weekday();
	// get DOM from URL or file
	$html = file_get_html($msn_link);
	if(empty($city_name)){
		$thanhpho = $html->find('#maincontent .outer .mylocations h2', 0)->innertext;
	}
	else{
		$thanhpho = $city_name;
	}
	

	
	?>
	<div class="homnay">
		<div class="homnay-inner">
		<div class="homnay-inner1">
			<?php
			$today = '';
			$homnay = $html->find('div.curcond', 0)->innertext;
			$today .= "<div class='wqn-curent'>";
			$today .= "<h3>" . $thanhpho . "</h3>";
			$today .= "<span>" . wqn_get_current_weekday(date('l')) ."</span>, ";
			$today .= "<span>" . date("d/m/Y") . "<span>" ;
			$today .= '</div>';
			echo $today;
			echo $homnay. '<br>';
			?>
			<div class="ha_clear"></div>
		</div>
		</div>
	</div>
	
	<div class="ngaymai">
		<div class="ngaymai-inner">
		<?php
			
			$ngaymai = $html->find('ul.forecast-list > li a', 1)->innertext;
			if($ngaymai):
			echo wqn_get_current_weekday(date('l', strtotime("+1 days"))) . '<br />';
			echo date('d/m/Y', strtotime("+1 days"));
			$tmp1 = str_get_html($ngaymai);
			$tmp1->find('div.dt', 0)->innertext = '';
			echo $tmp1. '<br>';
			//echo $ngaymai . '<br>';
			else:
			echo 'link wrong !!!';
			endif;
		?>
		</div>
	</div>
	<div class="ngaykia">
		<div class="ngaykia-inner">
			<?php
			
			$ngaykia = $html->find('ul.forecast-list > li a', 2)->innertext;
			if($ngaykia):
			echo wqn_get_current_weekday(date('l', strtotime("+2 days"))) . '<br />';
			echo date('d/m/Y', strtotime("+2 days"));
			$tmp2 = str_get_html($ngaykia);
			$tmp2->find('div.dt', 0)->innertext = '';
			echo $tmp2. '<br>';
			else:
			echo 'link wrong !!!';
			endif;
			?>
		</div>
	</div>
	<div class="ha_clear"></div>
</div>
</div>