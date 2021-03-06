<?php

/*  # Plugin Name: Appointment Calendar
  # Version: 2.7.6.2
  # Description: Easily accept and manage online appointments on your WordPress blog.
  # Author: Scientech It Solution
  # Author URI: http://www.appointzilla.com
  # Plugin URI: http://appointzilla.com/see-a-demo/

  # This program is free software; you can redistribute it and/or modify
  # it under the terms of the GNU General Public License as published by
  # the Free Software Foundation; either version 3 of the License, or
  # (at your option) any later version.

  # This program is distributed in the hope that it will be useful,
  # but WITHOUT ANY WARRANTY; without even the implied warranty of
  # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  # GNU General Public License for more details.

  # You should have received a copy of the GNU General Public License
  # along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

// Exit if accessed directly.
if (!defined('ABSPATH'))
    exit;

define("appointzilladir", plugin_dir_path(__FILE__));
define("appointzillaexportlisturl", plugins_url('appointments-lists/', __FILE__));


// Run 'Install' script on plugin activation
register_activation_hook(__FILE__, 'InstallScript');

function InstallScript() {
    require_once('install-script.php');
}

// Translate all text & labels of plugin
add_action('plugins_loaded', 'LoadPluginLanguage');

function LoadPluginLanguage() {
    load_plugin_textdomain('appointzilla', FALSE, dirname(plugin_basename(__FILE__)) . '/languages/');
}

// Admin dashboard Menu Pages For Booking Calendar Plugin
add_action('admin_menu', 'appointment_calendar_menu');

function appointment_calendar_menu() {

    //create new top-level menu 'appointment-calendar'
    $menu = add_menu_page('Appointment Calendar', __('Appointment Calendar', 'appointzilla'), 'administrator', 'appointment-calendar', '', 'dashicons-calendar');

    // Calendar Page
    $SubMenu1 = add_submenu_page('appointment-calendar', 'Admin Calendar', __('Admin Calendar', 'appointzilla'), 'administrator', 'appointment-calendar', 'display_calendar_page');

    // Time sloat Page
    $SubMenu2 = add_submenu_page('', 'Manage Time Slot', '', 'administrator', 'time_slot', 'display_time_slot_page');

    // Data Save Page
    $SubMenu3 = add_submenu_page('', 'Data Save', '', 'administrator', 'data-save', 'display_data_save_page');

    // Service Page
    $SubMenu4 = add_submenu_page('appointment-calendar', 'Services', __('Services', 'appointzilla'), 'administrator', 'service', 'display_service_page');

    // manage Service Page
    $SubMenu5 = add_submenu_page('', 'Manage Service', '', 'administrator', 'manage-service', 'display_manage_service_page');
    // Time-Off Page
    $SubMenu6 = add_submenu_page('appointment-calendar', 'Time Off', __('Time Off', 'appointzilla'), 'administrator', 'timeoff', 'display_time_off_page');

    // Update Time-Off Page
    $SubMenu7 = add_submenu_page('', 'Update TimeOff', '', 'administrator', 'update-time-off', 'display_update_time_off_page');

    // Manage Appointment Page
    $SubMenu8 = add_submenu_page('appointment-calendar', 'Appointments', __('Appointments', 'appointzilla'), 'administrator', 'manage-appointments', 'display_manage_appointment_page');

    // Update Appointments Page
    $SubMenu9 = add_submenu_page('', 'Update Appointment', '', 'administrator', 'update-appointment', 'display_update_appointment_page');

    // Settings Page
    $SubMenu10 = add_submenu_page('appointment-calendar', 'Settings', __('Settings', 'appointzilla'), 'administrator', 'settings', 'display_settings_page');

    // Export Lists
    $SubMenu17 = add_submenu_page('appointment-calendar', 'Export Lists', __('Export Appointments', 'appointzilla'), 'administrator', 'apcal-export-lists', 'display_export_lists_page');

    // Remove Plugin
    $SubMenu14 = add_submenu_page('appointment-calendar', 'Remove Plugin Data', __('Remove Plugin Data', 'appointzilla'), 'administrator', 'uninstall-plugin', 'display_uninstall_plugin_page');

    // Help & Support
    $SubMenu16 = add_submenu_page('appointment-calendar', 'Help & Support', __('Help & Support', 'appointzilla'), 'administrator', 'help-support', 'display_help_and_support_page');

    // Get Premium Plugin
    $SubMenu15 = add_submenu_page('appointment-calendar', 'Get Appointment Calendar Premium Plugin', __('Premium Plugin', 'appointzilla'), 'administrator', 'get-premium-plugin', 'display_get_premium_plugin_page');

    //Get Premium Themes
    $SubMenu18 = add_submenu_page('appointment-calendar', 'Webriti Premium Themes', __('Premium Themes', 'appointzilla'), 'administrator', 'get-premium-themes', 'display_get_premium_themes_page');

    // Service Page
    $SubMenu19 = add_submenu_page('appointment-calendar', 'Staff', __('Staff', 'appointzilla'), 'administrator', 'staff', 'display_staff_page');

    // manage Service Page
    $SubMenu20 = add_submenu_page('', 'Manage Staff', '', 'administrator', 'manage-staff', 'display_manage_staff_page');
        
    add_action('admin_print_styles-' . $menu, 'calendar_css_js');

    //calendar
    add_action('admin_print_styles-' . $SubMenu1, 'calendar_css_js');
    add_action('admin_print_styles-' . $SubMenu2, 'calendar_css_js');
    add_action('admin_print_styles-' . $SubMenu3, 'calendar_css_js');

    //service
    add_action('admin_print_styles-' . $SubMenu4, 'other_pages_css_js');

    add_action('admin_print_styles-' . $SubMenu5, 'other_pages_css_js');
    
    //staff
    add_action('admin_print_styles-' . $SubMenu19, 'other_pages_css_js');

    add_action('admin_print_styles-' . $SubMenu20, 'other_pages_css_js');

    //time-off
    add_action('admin_print_styles-' . $SubMenu6, 'other_pages_css_js');

    add_action('admin_print_styles-' . $SubMenu7, 'other_pages_css_js');

    //manage app
    add_action('admin_print_styles-' . $SubMenu8, 'other_pages_css_js');

    add_action('admin_print_styles-' . $SubMenu9, 'other_pages_css_js');

    //calendar settings
    add_action('admin_print_styles-' . $SubMenu10, 'other_pages_css_js');

    //remove plugin
    add_action('admin_print_styles-' . $SubMenu14, 'other_pages_css_js');

    //Get Premium plugin
    add_action('admin_print_styles-' . $SubMenu15, 'other_pages_css_js');

    //help & support
    add_action('admin_print_styles-' . $SubMenu16, 'other_pages_css_js');

    //export lists
    add_action('admin_print_styles-' . $SubMenu17, 'other_pages_css_js');

    //get premium themes
    add_action('admin_print_styles-' . $SubMenu18, 'other_pages_css_js');
    
    
}

//end of menu function

function calendar_css_js() {

    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-custom');
    wp_enqueue_script('jquery-ui-slider');

    wp_enqueue_script('full-calendar-min-js', plugins_url('/menu-pages/fullcalendar-assets-new/js/fullcalendar.min.js', __FILE__), array('jquery-ui-datepicker'));

    wp_register_style('bootstrap-css', plugins_url('/menu-pages/bootstrap-assets/css/bootstrap.css', __FILE__));
    wp_enqueue_style('bootstrap-css');

    wp_enqueue_style('full-calendar-css', plugins_url('/menu-pages/fullcalendar-assets-new/css/fullcalendar.css', __FILE__));
    wp_enqueue_style('date-picker-css', plugins_url('/menu-pages/datepicker-assets/css/jquery-ui-1.8.23.custom.css', __FILE__));

    //font-awesome js n css
    wp_enqueue_style('font-awesome-css', plugins_url('/menu-pages/font-awesome-assets/css/font-awesome.css', __FILE__));
}

function other_pages_css_js() {

    // bootstrap css files
    wp_register_style('bootstrap-css', plugins_url('/menu-pages/bootstrap-assets/css/bootstrap.css', __FILE__));
    wp_enqueue_style('bootstrap-css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-custom');
    wp_enqueue_script('jquery-ui-slider');

    wp_enqueue_script('tooltip', plugins_url('/menu-pages/bootstrap-assets/js/bootstrap-tooltip.js', __FILE__));
    wp_enqueue_script('bootstrap-affix', plugins_url('/menu-pages/bootstrap-assets/js/bootstrap-affix.js', __FILE__));
    wp_enqueue_script('bootstrap-application', plugins_url('/menu-pages/bootstrap-assets/js/application.js', __FILE__));

    // font-awesome js n css
    wp_enqueue_style('font-awesome-css', plugins_url('/menu-pages/font-awesome-assets/css/font-awesome.css', __FILE__));

    // date-picker-css
    wp_enqueue_style('date-picker-css', plugins_url('/menu-pages/datepicker-assets/css/jquery-ui-1.8.23.custom.css', __FILE__));

    // export
    wp_enqueue_script('jquery-ui-timepicker', plugins_url('/menu-pages/timepicker-assets/js/jquery-ui-timepicker-addon.js', __FILE__), array('jquery-ui-datepicker'));
    wp_enqueue_script('jquery-date', plugins_url('/menu-pages/js/date.js', __FILE__));

    // bootstrap js files
    wp_enqueue_script('bootstrap-js', plugins_url('/menu-pages/bootstrap-assets/js/bootstrap.js', __FILE__));
    wp_enqueue_script('bootstrap-min-js', plugins_url('/menu-pages/bootstrap-assets/js/bootstrap.min.js', __FILE__));
    wp_enqueue_script('bootstrap-tab-js', plugins_url('/menu-pages/bootstrap-assets/js/bootstrap-tab.js', __FILE__));
}

function short_code_detect() {
    global $wp_query;
    $posts = $wp_query->posts;
    $pattern = get_shortcode_regex();
    foreach ($posts as $post) {

        if (preg_match_all('/' . $pattern . '/s', $post->post_content, $matches) && array_key_exists(2, $matches) && in_array('APCAL_PC', $matches[2]) || in_array('APCAL_MOBILE', $matches[2]) || in_array('APCAL', $matches[2])) {

            // full-calendar scripts
            wp_enqueue_style('fullcalendar-css', plugins_url('/menu-pages/fullcalendar-assets-new/css/fullcalendar.css', __FILE__));

            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-custom');
            wp_enqueue_script('jquery-ui-slider');

            wp_enqueue_script('full-calendar', plugins_url('/menu-pages/fullcalendar-assets-new/js/fullcalendar.min.js', __FILE__), array('jquery-ui-datepicker'));

            // calendar js
            wp_enqueue_script('calendar', plugins_url('calendar/calendar.js', __FILE__));

            // moment min css
            wp_enqueue_script('moment-min', plugins_url('calendar/moment.min.js', __FILE__));

            // bootstrap apcal
            wp_enqueue_style('bootstrap-apcal', plugins_url('/menu-pages/bootstrap-assets/css/bootstrap-apcal.css', __FILE__));

            // datepicker css
            wp_enqueue_style('datepicker-css', plugins_url('/menu-pages/datepicker-assets/css/jquery-ui-1.8.23.custom.css', __FILE__));
            break;
        }
    }
}

add_action('wp', 'short_code_detect');

//calendar page
function display_calendar_page() {
    require_once('menu-pages/calendar.php');
}

//time slot page
function display_time_slot_page() {
    require_once("menu-pages/appointment-form2.php");
}

//appointment save page
function display_data_save_page() {
    require_once("menu-pages/data-save.php");
}

//service page
function display_service_page() {
    require_once("menu-pages/service.php");
}

//staff page
function display_staff_page() {
    require_once("menu-pages/staff.php");
}


//manage service page
function display_manage_service_page() {
    require_once("menu-pages/manage-service.php");
}

//manage staff page
function display_manage_staff_page() {
    require_once("menu-pages/manage-staff.php");
}


//time-off page
function display_time_off_page() {
    require_once("menu-pages/timeoff.php");
}

//update-time-off page
function display_update_time_off_page() {
    require_once("menu-pages/update-time-off.php");
}

//manage-appointment page
function display_manage_appointment_page() {
    require_once("menu-pages/manage-appointments.php");
}

function display_update_appointment_page() {
    require_once("menu-pages/update-appointments.php");
}

//settings page
function display_settings_page() {
    require_once("menu-pages/settings.php");
}

// Remove plugin
function display_uninstall_plugin_page() {
    require_once("uninstall-plugin.php");
}

//get-premium-plugin page
function display_get_premium_plugin_page() {
    require_once("menu-pages/get-premium-plugin.php");
}

//get-premium-themes page
function display_get_premium_themes_page() {
    require_once("menu-pages/get-premium-themes.php");
}

//help & support page
function display_help_and_support_page() {
    require_once("menu-pages/help-and-support.php");
}

//Export Lists
function display_export_lists_page() {
    require_once("menu-pages/export-lists.php");
}

// Including Calendar Short-Code Page
require_once("appointment-calendar-shortcode.php");
require_once("appointment-calendar-mobile.php");


// Ajax Handler
add_action('wp_ajax_nopriv_preluare_angajati', 'preluareListaAngajati');
add_action('wp_ajax_preluare_angajati', 'preluareListaAngajati');

add_action('wp_ajax_nopriv_afisare_calendar_serviciu', 'afisareCalendar');
add_action('wp_ajax_afisare_calendar_serviciu', 'afisareCalendar');


function preluareListaAngajati() {
    global $wpdb;
    
    // Get the Post ID from the URL
    $serviciu = $_REQUEST['serviciu'];


    $EmplServTable = $wpdb->prefix . "ap_staff_services_relationship";
    $EmployeeTable = $wpdb->prefix . "ap_staff";

    $sql = "SELECT * FROM `$EmployeeTable` AS e INNER JOIN `$EmplServTable` AS es ON e.id = es.staff_id WHERE es.service_id = '$serviciu' ";

    $AllEmployees = $wpdb->get_results($wpdb->prepare($sql));

    if (!$AllEmployees) {
        $response = array(
            'status' => 'error',
            'message' => 'Nu exista angajati!',
            'employees' => array(),
        );
    } else {        
        $response = array(
            'status' => 'success',
            'message' => 'Am gasit angajatii!',
            'employees' => $AllEmployees
        );
    }

    wp_send_json($response);

    // Always exit when doing Ajax
    exit();
}

function afisareCalendar() {
//Loading Appointments On Calendar Start - DE PUS DUPA AJAAAAAX
      global $wpdb;
      $serviciu1 = $_REQUEST['serviciu'];
      $AppointmentTableName = $wpdb->prefix . "ap_appointments";
      $AllAppointments = $wpdb->get_results($wpdb->prepare("select name, start_time, end_time, date FROM $AppointmentTableName where id > %d AND staff_id = %d", null, $serviciu1), OBJECT);

      if ($AllAppointments) {
      foreach ($AllAppointments as $single) {
      $title = $single->name;
      $start = date("H, i", strtotime($single->start_time));
      $end = date("H, i", strtotime($single->end_time));

      // subtract 1 from month digit coz calendar work on month 0-11
      $y = date('Y', strtotime($single->date));
      $m = date('n', strtotime($single->date)) - 1;
      $d = date('d', strtotime($single->date));
      $date = "$y-$m-$d";

      $date = str_replace("-", ", ", $date);
      ?> 
      {
      title: "<?php _e("Rezervat", "appointzilla"); ?>",
      start: new Date(<?php echo "$date, $start"; ?>),
      end: new Date(<?php echo "$date, $end"; ?>),
      allDay: false,
      backgroundColor : "#f22e2e",
      textColor: "black",
      }, <?php
      }
      }
    
}
