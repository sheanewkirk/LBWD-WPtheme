<?php
function theme_settings_page(){
  // CREATE THEME SETTINGS SUBMIT BUTTON
  // ==================================================
  ?>
	    <div class="wrap">
	    <h1>Theme Settings</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");
	            submit_button();
	        ?>
	    </form>
		</div>
	<?php
}

// INSERTS THEME SETTINGS MENU ITEM
// ==================================================
 function add_theme_menu_item(){
   add_menu_page("Theme Panel", "Theme Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
 }

 add_action("admin_menu", "add_theme_menu_item");

 // CONTACT INFO
 // ==================================================
 function display_email_element(){
 	?>
     	<input type="email" name="email_url" id="email_url" value="<?php echo get_option('email_url'); ?>" />
     <?php
 }

 function display_phone_element(){
   ?>
       <input type="tel" name="phone_url" id="phone_url" value="<?php echo get_option('phone_url'); ?>" />
     <?php
 }

 function display_phonelink_element(){
   ?>
       <input type="text" name="phonelink_url" id="phonelink_url" value="<?php echo get_option('phonelink_url'); ?>" />
     <?php
 }

 function display_address_element(){
   ?>
       <input type="text" name="address_url" id="address_url" value="<?php echo get_option('address_url'); ?>" />
     <?php
 }

 function display_state_element(){
   ?>
       <input type="text" name="state_url" id="state_url" value="<?php echo get_option('state_url'); ?>" />
     <?php
 }

 function display_maplink_element(){
   ?>
       <input type="text" name="maplink_url" id="maplink_url" value="<?php echo get_option('maplink_url'); ?>" />
     <?php
 }

function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");
  add_settings_field("phone_url", "Business Phone Number", "display_phone_element", "theme-options", "section");
  add_settings_field("phone_link", "Business Phone Link", "display_phonelink_element", "theme-options", "section");
  add_settings_field("email_url", "Business Email Address", "display_email_element", "theme-options", "section");
  add_settings_field("address_url", "Business Street Address", "display_address_element", "theme-options", "section");
  add_settings_field("state_url", "Business City, State, Zip", "display_state_element", "theme-options", "section");
  add_settings_field("maplink_url", "Link to Google Map Location", "display_maplink_element", "theme-options", "section");

  register_setting("section", "phone_url");
  register_setting("section", "phonelink_url");
  register_setting("section", "email_url");
  register_setting("section", "address_url");
  register_setting("section", "state_url");
  register_setting("section", "maplink_url");
}

add_action("admin_init", "display_theme_panel_fields");
