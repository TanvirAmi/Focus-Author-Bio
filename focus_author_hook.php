<?php
/*
Plugin Name: Focus Author Bio
Plugin URI: http://
Description: This plugin will add a box of author bio bellow the single post of your website. 
Author: MD: Nahidul Islam Tanvir
Version: 1.0
Author URI: https://twitter.com/TanvirFocus
mail: tanvir.focus@gmail.com
*/

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class focus_author_box{
	//constructor method calling here
	public function __construct(){
		add_action('init', array($this, 'focus_redefine'));
		add_action('init', array($this, 'focus_bio_style'));
		add_action('wp_footer', array($this, 'fontawesome_authorbox'));
		add_filter('the_content', array($this, 'hook_after_post_content'));
		add_filter('user_contactmethods', array($this, 'authors_profile_field'));
	}

	// Setting up plugin DIR & URI
	public function focus_redefine(){
	        define('FOCUS_PLUG', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
	}

	//adding the plugin stylesheet
	public function focus_bio_style(){
		wp_enqueue_style('bio_css', FOCUS_PLUG.'css/box.css');
	}

	//fontawesome from CDN
	public function fontawesome_authorbox(){?>
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
		<?php
	}

	//add the author box bellow the single post content
	public function hook_after_post_content($content) {
		if (is_single()) { 

			$content .= '
				<div class="focuswarp">
				<div class="focusavatar">
					'. get_avatar( get_the_author_email(), '80' ) .'
				</div>
				<div class="focustext">
					<h4>Author: <span>'. get_the_author_link('display_name',get_query_var('author') ) .'</span></h4>'. get_the_author_meta('description',get_query_var('author') ) .'
				</div>';

			$content .= '
				<div class="focus-social">
				';
				if( get_the_author_meta('twitter',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'twitter' ) ) . '" target="_blank"><i class="fa fa-twitter fa-lg"></i> Twitter</a> ';
				
				if( get_the_author_meta('facebook',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'facebook' ) ) . '" target="_blank"><i class="fa fa-facebook fa-lg"></i> Facebook</a> ';
				
				if( get_the_author_meta('gplus',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'gplus' ) ) . '" target="_blank"><i class="fa fa-google-plus fa-lg"></i> Google+</a> ';
				
				if( get_the_author_meta('linkedin',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'linkedin' ) ) . '" target="_blank"><i class="fa fa-linkedin fa-lg"></i> Linkedin</a> ';
				
				if( get_the_author_meta('dribbble',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'dribbble' ) ) . '" target="_blank"><i class="fa fa-dribbble fa-lg"></i> Dribbble</a> ';
				
				if( get_the_author_meta('github',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'github' ) ) . '" target="_blank"><i class="fa fa-github fa-lg"></i> Github</a>';
				
				if( get_the_author_meta('youtube',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'youtube' ) ) . '" target="_blank"><i class="fa fa-youtube fa-lg"></i> Youtube</a>';
				
				if( get_the_author_meta('pinterest',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'pinterest' ) ) . '" target="_blank"><i class="fa fa-pinterest-square fa-lg"></i> Pinterest</a>';
				
				if( get_the_author_meta('instagram',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'instagram' ) ) . '" target="_blank"><i class="fa fa-instagram fa-lg"></i> Instagram</a>';
				
				if( get_the_author_meta('vimeo',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'vimeo' ) ) . '" target="_blank"><i class="fa fa-vimeo-square fa-lg"></i> vimeo</a>';
				
				if( get_the_author_meta('skype',get_query_var('author') ) )
					$content .= '<a href="' . esc_url( get_the_author_meta( 'skype' ) ) . '" target="_blank"><i class="fa fa-skype fa-lg"></i> Skype</a>';

			$content .= '
				</div>
				</div>';
		}
		return $content;
	}

	//add new profile field in users profile editor
	public function authors_profile_field($field_lebel) {

		// Add new fields
		$field_lebel['twitter'] = 'Twitter URL';
		$field_lebel['facebook'] = 'Facebook URL';
		$field_lebel['gplus'] = 'Google+ URL';
		$field_lebel['linkedin'] = 'Linkedin URL';
		$field_lebel['dribbble'] = 'Dribbble URL';
		$field_lebel['github'] = 'Github URL';
		$field_lebel['youtube'] = 'Youtube URL';
		$field_lebel['pinterest'] = 'Pinterest URL';
		$field_lebel['instagram'] = 'Instagram URL';
		$field_lebel['vimeo'] = 'Vimeo URL';
		$field_lebel['skype'] = 'Skype ID';

		return $field_lebel;
	}
}
$obj= new focus_author_box;
?>

