<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Plugin Name: Show weather get msn.com
 * Plugin URI: http://webquangnam.com/chia-se-suu-tam/wordpress/113-widget-hien-thi-thoi-tiet-cho-wordpress
 * Description: Wiget hiển thị thời tiết get HTML từ trang http://www.msn.com/en-us/weather
 * Version: 1.0
 * Author: Huỳnh Hoàng Anh
 * Author URI: http://webquangnam.com
 */

  
 
/**********************************************************
 * Tạo widget thời tiết
 **********************************************************/

add_action( 'wp_enqueue_scripts', 'wqn_weather_load_css_style' );
function wqn_weather_load_css_style() { 
  //wp_enqueue_style( 'wqn_weather_css', plugin_dir_url( __FILE__ ) . 'css/wqn_thoitiet.css', false, '1.0' );
  wp_enqueue_style( 'wqn_weather_css', plugins_url( '', __FILE__ ) . '/css/wqn_thoitiet.css', array(), WCSSC_PLUGIN_VERSION );
}
class wqn_weather_Widget extends WP_Widget {
  
  /**
   * Thiết lập widget: đặt tên, base ID
   */
  function wqn_weather_Widget() {
    $vbmwidget_options = array(
      'classname' => 'weather_widget_class', //ID của widget
      'description' => 'widget show weather get msn.com'
    );
    $this->WP_Widget('weather_widget_id', 'Show weather get msn.com', $vbmwidget_options);
  }
  
  /**
   * Tạo form option cho widget
   */
  function form( $instance ) {
    
    //Biến tạo các giá trị mặc định trong form
    $default = array(
      'title' => 'Đự báo thời tiết',
      'msn_link' => 'http://www.msn.com/vi-vn/weather/today/Th%C3%A0nh-Ph%E1%BB%91-Tam-K%E1%BB%B3,Qu%E1%BA%A3ng-Nam,Vi%E1%BB%87t-Nam/we-city?iso=VN&form=PRWLAS&q=%C4%90%C6%AF%E1%BB%9CNG%20Duy%20T%C3%A2n%2C%20Th%C3%A0nh%20Ph%E1%BB%91%20Tam%20K%E1%BB%B3%2C%20Vi%E1%BB%87t%20Nam&el=wIiefkcRzf8vwSLAHYHX3A%3D%3D',
      'city_name' => ''
    );
    
    //Gộp các giá trị trong mảng $default vào biến $instance để nó trở thành các giá trị mặc định
    $instance = wp_parse_args( (array) $instance, $default);
    
    //Tạo biến riêng cho giá trị mặc định trong mảng $default
    $title = esc_attr( $instance['title'] );
    $msn_link = esc_attr($instance['msn_link']);
    $city_name = esc_attr($instance['city_name']);
    
    //Hiển thị form trong option của widget
    echo "<p>Nhập tiêu đề: <input type='text' class='widefat' name='".$this->get_field_name('title')."' value='".$title."' /></p>";
    echo "<p>Nhập tỉnh thành: <input type='text' class='widefat' name='".$this->get_field_name('city_name')."' value='".$city_name."' /></p>";
    //echo '<p>Link: <input type="number" class="widefat" name="'.$this->get_field_name('msn_link').'" value="'.$msn_link.'" placeholder="'.$msn_link.'" max="30" /></p>';
    echo '<p>Link thời tiết : <textarea class="widefat" rows="6" name="'.$this->get_field_name('msn_link').'" >'.$msn_link.'</textarea></p>';
    echo '<p><a href = "http://webquangnam.com/chia-se-suu-tam/wordpress/113-widget-hien-thi-thoi-tiet-cho-wordpress" target="_blank"> Link hướng dẫn </a></p>';
    
    
  }
  
  /**
   * save widget form
   */
  
  function update( $new_instance, $old_instance ) {
    
    $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['msn_link'] = strip_tags($new_instance['msn_link']);
        $instance['city_name'] = strip_tags($new_instance['city_name']);
        return $instance;
  }
  
  /**
   * Show widget
   */
  
  function widget( $args, $instance ) {
    
    extract($args);
        $title = apply_filters( 'widget_title', $instance['title'] );
        $msn_link = $instance['msn_link'];
        $city_name = $instance['city_name'];
 
    
    echo $before_widget;
    
    //In tiêu đề widget
    echo $before_title.$title.$after_title;

    // Nội dung trong widget
    include ('data.php');
    //include_once ( get_template_directory() . '/Mobile_Detect.php');
   
    // Kết thúc nội dung trong widget
    
    echo $after_widget;
  }
  
}

/*
 * Khởi tạo widget item
 */
add_action( 'widgets_init', 'create_wqn_weather_widget' );
function create_wqn_weather_widget() {
  register_widget('wqn_weather_Widget');
}

/**
 * END viet code cho widget văn bản mới
 */