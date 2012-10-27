<?php 

/*
*  Input
*
*  @description: All the functionality for adding fields to a page / post
*  @since 3.2.6
*  @created: 23/06/12
*/

 
class acf_input
{

	var $parent,
		$data;
		
	
	/*
	*  __construct
	*
	*  @description: 
	*  @since 3.1.8
	*  @created: 23/06/12
	*/
	
	function __construct($parent)
	{
	
		// vars
		$this->parent = $parent;
		
		
		// actions
		add_action('admin_print_scripts', array($this,'admin_print_scripts'));
		add_action('admin_print_styles', array($this,'admin_print_styles'));
		add_action('admin_head', array($this,'admin_head'));
		add_action('save_post', array($this, 'save_post'), 20); // save later to avoid issues with 3rd party plugins
		
		
		// custom actions (added in 3.1.8)
		add_action('acf_head-input', array($this, 'acf_head_input'));
		add_action('acf_print_scripts-input', array($this, 'acf_print_scripts_input'));
		add_action('acf_print_styles-input', array($this, 'acf_print_styles_input'));
		
		
		// ajax
		add_action('wp_ajax_acf_input', array($this, 'ajax_acf_input'));
		add_action('wp_ajax_get_input_style', array($this, 'ajax_get_input_style'));
		
		
		// edit attachment hooks (used by image / file / gallery)
		add_action('admin_head-media.php', array($this, 'admin_head_media'));
		add_action('admin_head-upload.php', array($this, 'admin_head_upload'));
	}
	
	
	/*
	*  validate_page
	*
	*  @description: returns true | false. Used to stop a function from continuing
	*  @since 3.2.6
	*  @created: 23/06/12
	*/
	
	function validate_page()
	{
		// global
		global $pagenow, $typenow;
		
		
		// vars
		$return = false;
		
		
		// validate page
		if( in_array( $pagenow, array('post.php', 'post-new.php') ) )
		{
		
			// validate post type
			global $typenow;
			
			if( $typenow != "acf" )
			{
				$return = true;
			}
			
		}
		
		
		// validate page (Shopp)
		if( $pagenow == "admin.php" && isset( $_GET['page'] ) && $_GET['page'] == "shopp-products" && isset( $_GET['id'] ) )
		{
			$return = true;
		}
		
		
		// return
		return $return;
	}
	
	
	/*
	*  admin_print_scripts
	*
	*  @description: 
	*  @since 3.1.8
	*  @created: 23/06/12
	*/
	
	function admin_print_scripts()
	{
		// validate page
		if( ! $this->validate_page() ) return;
		
		do_action('acf_print_scripts-input');
	}
	
	
	/*
	*  admin_print_styles
	*
	*  @description: 
	*  @since 3.1.8
	*  @created: 23/06/12
	*/
	
	function admin_print_styles()
	{
		// validate page
		if( ! $this->validate_page() ) return;
		
		do_action('acf_print_styles-input');
	}
	
	
	/*
	*  admin_head
	*
	*  @description: 
	*  @since 3.1.8
	*  @created: 23/06/12
	*/
	
	function admin_head()
	{
		// validate page
		if( ! $this->validate_page() ) return;
		
		
		// globals
		global $post, $pagenow, $typenow;
		
		
		// shopp
		if( $pagenow == "admin.php" && isset( $_GET['page'] ) && $_GET['page'] == "shopp-products" && isset( $_GET['id'] ) && $_GET['id'] == "new" )
		{
			$typenow = "shopp_product";
		}
		
		
		// vars
		$post_id = 0;
		
		if( $post )
		{
			$post_id = $post->ID;
		}
		
			
		// get style for page
		$metabox_ids = $this->parent->get_input_metabox_ids( array( 'post_id' => $post_id, 'post_type' => $typenow ), false);
		$style = isset($metabox_ids[0]) ? $this->get_input_style($metabox_ids[0]) : '';
		echo '<style type="text/css" id="acf_style" >' .$style . '</style>';
		

		// Style
		echo '<link rel="stylesheet" type="text/css" href="' . $this->parent->dir . '/css/global.css?ver=' . $this->parent->version . '" />';
		echo '<link rel="stylesheet" type="text/css" href="' . $this->parent->dir . '/css/input.css?ver=' . $this->parent->version . '" />';
		echo '<style type="text/css">.acf_postbox, .postbox[id*="acf_"] { display: none; }</style>';
		
		
		// Javascript
		echo '<script type="text/javascript" src="' . $this->parent->dir . '/js/input-actions.js?ver=' . $this->parent->version . '" ></script>';
		echo '<script type="text/javascript" src="' . $this->parent->dir . '/js/input-ajax.js?ver=' . $this->parent->version . '" ></script>';
		echo '<script type="text/javascript">acf.post_id = ' . $post_id . ';</script>';
		
		
		// add user js + css
		do_action('acf_head-input');
		
		
		// get acf's
		$acfs = $this->parent->get_field_groups();
		
		if($acfs)
		{
			foreach($acfs as $acf)
			{
				// hide / show
				$show = in_array($acf['id'], $metabox_ids) ? "true" : "false";
				
				// add meta box
				add_meta_box(
					'acf_' . $acf['id'], 
					$acf['title'], 
					array($this, 'meta_box_input'), 
					$typenow, 
					$acf['options']['position'], 
					'core', 
					array( 'fields' => $acf['fields'], 'options' => $acf['options'], 'show' => $show, 'post_id' => $post->ID )
				);
			}
			// foreach($acfs as $acf)
		}
		// if($acfs)
	}
	
	
	/*
	*  get_input_style
	*
	*  @description: called by admin_head to generate acf css style (hide other metaboxes)
	*  @since 2.0.5
	*  @created: 23/06/12
	*/

	function get_input_style($acf_id = false)
	{
		// vars
		$acfs = $this->parent->get_field_groups();
		$html = "";
		
		// find acf
		if($acfs)
		{
			foreach($acfs as $acf)
			{
				if($acf['id'] != $acf_id) continue;
				

				// add style to html 
				if( in_array('the_content',$acf['options']['hide_on_screen']) )
				{
					$html .= '#postdivrich {display: none;} ';
				}
				if( in_array('excerpt',$acf['options']['hide_on_screen']) )
				{
					$html .= '#postexcerpt, #screen-meta label[for=postexcerpt-hide] {display: none;} ';
				}
				if( in_array('custom_fields',$acf['options']['hide_on_screen']) )
				{
					$html .= '#postcustom, #screen-meta label[for=postcustom-hide] { display: none; } ';
				}
				if( in_array('discussion',$acf['options']['hide_on_screen']) )
				{
					$html .= '#commentstatusdiv, #screen-meta label[for=commentstatusdiv-hide] {display: none;} ';
				}
				if( in_array('comments',$acf['options']['hide_on_screen']) )
				{
					$html .= '#commentsdiv, #screen-meta label[for=commentsdiv-hide] {display: none;} ';
				}
				if( in_array('slug',$acf['options']['hide_on_screen']) )
				{
					$html .= '#slugdiv, #screen-meta label[for=slugdiv-hide] {display: none;} ';
				}
				if( in_array('author',$acf['options']['hide_on_screen']) )
				{
					$html .= '#authordiv, #screen-meta label[for=authordiv-hide] {display: none;} ';
				}
				if( in_array('format',$acf['options']['hide_on_screen']) )
				{
					$html .= '#formatdiv, #screen-meta label[for=formatdiv-hide] {display: none;} ';
				}
				if( in_array('featured_image',$acf['options']['hide_on_screen']) )
				{
					$html .= '#postimagediv, #screen-meta label[for=postimagediv-hide] {display: none;} ';
				}
				
				
				break;

			}
			// foreach($acfs as $acf)
		}
		//if($acfs)
		
		return $html;
	}
	
	
	/*
	*  the_input_style
	*
	*  @description: called by input-actions.js to hide / show other metaboxes
	*  @since 2.0.5
	*  @created: 23/06/12
	*/
	
	function ajax_get_input_style()
	{
		// overrides
		if(isset($_POST['acf_id']))
		{
			echo $this->get_input_style($_POST['acf_id']);
		}
		
		die;
	}
	
	
	/*
	*  meta_box_input
	*
	*  @description: 
	*  @since 1.0.0
	*  @created: 23/06/12
	*/
	
	function meta_box_input($post, $args)
	{
		// vars
		$fields = isset($args['args']['fields']) ? $args['args']['fields'] : false ;	
		$options = isset($args['args']['options']) ? $args['args']['options'] : false;
		$show = isset($args['args']['show']) ? $args['args']['show'] : "false";
		$post_id = isset($args['args']['post_id']) ? $args['args']['post_id'] : false;
		
		
		// defaults
		if(!$options)
		{
			$options = array(
				'layout'	=>	'default'
			);
		}
		
		if($fields)
		{
			echo '<input type="hidden" name="save_input" value="true" />';
			echo '<div class="options" data-layout="' . $options['layout'] . '" data-show="' . $show . '" style="display:none"></div>';
			
			if($show == "false")
			{
				// don't create fields
				echo '<div class="acf-replace-with-fields"><div class="acf-loading"></div></div>';
			}
			else
			{
				
				
				$this->parent->render_fields_for_input($fields, $post_id);
			}
		}
	}
	
	
	/*
	*  ajax_acf_input
	*
	*  @description: 
	*  @since 3.1.6
	*  @created: 23/06/12
	*/

	function ajax_acf_input()
	{
		
		// defaults
		$defaults = array(
			'acf_id' => null,
			'post_id' => null,
		);
		
		// load post options
		$options = array_merge($defaults, $_POST);
		
		// required
		if(!$options['acf_id'] || !$options['post_id'])
		{
			echo "";
			die();
		}
		
		// get fields
		$fields = $this->parent->get_acf_fields($options['acf_id']);
		
		$this->parent->render_fields_for_input($fields, $options['post_id']);

		die();
		
	}
	
	
	/*
	*  save_post
	*
	*  @description: Saves the field / location / option data for a field group
	*  @since 1.0.0
	*  @created: 23/06/12
	*/
	
	function save_post($post_id)
	{	
		
		// do not save if this is an auto save routine
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		
		
		// only for save acf
		if( ! isset($_POST['save_input']) || $_POST['save_input'] != 'true')
		{
			return $post_id;
		}
		
		
		// only save once! WordPress save's a revision as well.
		if( wp_is_post_revision($post_id) )
		{
	    	return $post_id;
        }
        
		
		do_action('acf_save_post', $post_id);
	}
	
	
	/*--------------------------------------------------------------------------------------
	*
	*	acf_head_input
	*
	*	This is fired from an action: acf_head-input
	*
	*	@author Elliot Condon
	*	@since 3.0.6
	* 
	*-------------------------------------------------------------------------------------*/
	
	function acf_head_input()
	{
		
		?>
<script type="text/javascript">

// admin url
acf.admin_url = "<?php echo admin_url(); ?>";
	
// messages
acf.text.validation_error = "<?php _e("Validation Failed. One or more fields below are required.",'acf'); ?>";
acf.text.file_tb_title_add = "<?php _e("Add File to Field",'acf'); ?>";
acf.text.file_tb_title_edit = "<?php _e("Edit File",'acf'); ?>";
acf.text.image_tb_title_add = "<?php _e("Add Image to Field",'acf'); ?>";
acf.text.image_tb_title_edit = "<?php _e("Edit Image",'acf'); ?>";
acf.text.relationship_max_alert = "<?php _e("Maximum values reached ( {max} values )",'acf'); ?>";
acf.text.gallery_tb_title_add = "<?php _e("Add Image to Gallery",'acf'); ?>";
acf.text.gallery_tb_title_edit = "<?php _e("Edit Image",'acf'); ?>";

</script>
		<?php
		
		foreach($this->parent->fields as $field)
		{
			$field->admin_head();
		}
	}
	
	
	/*--------------------------------------------------------------------------------------
	*
	*	acf_print_scripts
	*
	*	@author Elliot Condon
	*	@since 3.1.8
	* 
	*-------------------------------------------------------------------------------------*/
	
	function acf_print_scripts_input()
	{
		foreach($this->parent->fields as $field)
		{
			$field->admin_print_scripts();
		}
	}
	
	
	/*--------------------------------------------------------------------------------------
	*
	*	acf_print_styles
	*
	*	@author Elliot Condon
	*	@since 3.1.8
	* 
	*-------------------------------------------------------------------------------------*/
	
	function acf_print_styles_input()
	{
		foreach($this->parent->fields as $field)
		{
			$field->admin_print_styles();
		}
	}
	
	
	/*
	*  admin_head_upload
	*
	*  @description: 
	*  @since 3.2.6
	*  @created: 3/07/12
	*/
	
	function admin_head_upload()
	{
		// vars
		$defaults = array(
			'acf_action'	=>	null,
			'acf_field'		=>	'',
		);
		
		$options = array_merge($defaults, wp_parse_args( wp_get_referer() ));
		
		
		// validate
		if( $options['acf_action'] != 'edit_attachment')
		{
			return false;
		}
		
		
		// call the apropriate field action
		do_action('acf_head-update_attachment-' . $options['acf_field']);
		
		?>
<script type="text/javascript">

	// reset global
	self.parent.acf_edit_attachment = null;
	
	// remove tb
	self.parent.tb_remove();
	
</script>
</head>
<body>
	
	<div class="updated" id="message"><p><?php _e("Attachment updated",'acf'); ?>.</div>
	
</body>
</html
		<?php
		
		die;
	}
	
	
	/*
	*  admin_head_media
	*
	*  @description: 
	*  @since 3.2.6
	*  @created: 3/07/12
	*/
	
	function admin_head_media()
	{

		// vars
		$defaults = array(
			'acf_action'	=>	null,
			'acf_field'		=>	'',
		);
		
		$options = array_merge($defaults, $_GET);
		
		
		// validate
		if( $options['acf_action'] != 'edit_attachment')
		{
			return false;
		}
		
		?>
<style type="text/css">
#wpadminbar,
#adminmenuback,
#adminmenuwrap,
#footer,
#media-single-form > .submit:first-child,
#media-single-form td.savesend,
.add-new-h2 {
	display: none;
}

#wpcontent {
	margin-left: 0px !important;
}

.wrap {
	margin: 20px 15px;
}

html.wp-toolbar {
    padding-top: 0px;
}
</style>
<script type="text/javascript">
(function($){
	
	$(document).ready( function(){
		
		$('#media-single-form').append('<input type="hidden" name="acf_action" value="<?php echo $options['acf_action']; ?>" />');
		$('#media-single-form').append('<input type="hidden" name="acf_field" value="<?php echo $options['acf_field']; ?>" />');
		
	});
		
})(jQuery);
</script>
		<?php
		
		do_action('acf_head-edit_attachment');
	}
	
}

?>