<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sait.com.ng
 * @since      1.0.0
 *
 * @package    saittech-ptalc
 * @subpackage saittech-ptalc/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    saittech-ptalc
 * @subpackage saittech-ptalc/admin
 * @author     Samuel O <io@sait.com.ng>
 */
class PostsTitleAndLinkCollationAdmin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $site_name;

	private $site_url;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->site_url = \get_bloginfo('url');
		$this->site_name = \get_bloginfo('name');

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/saittech-ptalc-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/saittech-ptalc-admin.js', array( 'jquery' ), $this->version, false );

	}

	private function generatePostLink(\WP_Post $post, $year, $mm, $dd){
		$link = $this->site_url."/$year/$mm/$dd/".$post->post_name;
		$a = "<a href=".$link.">".$link."</a>";
		return $a;
	}

	private function widgetFooter(){
		$li = "<li>
			<i>
				To learn more about Hensardtimes, its programmes, and the admissions process, you can visit the official website at 
				https://hensardtimes.ng. For inquiries or more information, you can reach out through the following channels:
			</i>
		</li>
		<li>
			<strong>Social Media:</strong> <br />
			<i>Twitter - @HensardUni</i> <br />
			<i>Facebook - @Hensardrimes</i> <br />
			<i>Instagram - @Hensardtimes</i> <br />
			<i>LinkedIn - @Hensardtimes</i> <br />
			<i>YouTube - @Hensardtimes</i>
		</li>
		<li>
		    <strong>Email: </strong>hensadtimes@gmail.com <br />
			Admissions Office - Admissions@hensarduniversity.edu.ng
		</li>
		<li>
			<strong>Phone Numbers: </strong>
			Enquiries - +234 9133780016, <br />
			+234 803 407 5113 <br />
			Admissions Office - +234 916 998 5160
		</li>
		";

		return "<ul>$li</ul>";
	}

	private function postsWidget() {
		$html = '';
		$date = getdate();
		$year =  $date['year'];
		$mm =  $date['mon']; 
		$dd =  $date['mday'];
		$weekday = $date['weekday'];
		$month = $date['month'];

		if ($mm < 10) {
			$mm = "0$mm";
		}

		if ($dd < 10) {
			$dd = "0$dd";
		}

		$site_name = $this->site_name;

		$query = new WP_Query([
			'post_type' => 'post',
			'post_status' => 'publish',
			'date_query' => array(
				'year'  => $year,
				'month' => $mm,
				'day'   => $dd,
			)
		]);

		if ($query->have_posts()) {
			
			$title = "Today&quot;s News in The $site_name Online - $weekday, $month $dd, $year";

			$html = '<h3 style="width: 100%;"><br />'.$title.'</h3><ul style="margin-bottom: 20px;">';
			foreach ($query->get_posts() as $post) {
				$a = $this->generatePostLink($post, $year, $mm, $dd);
				$html = $html."<li>".$post->post_title."<br>".$a."</li>";
			}
			$html = $html.'</ul>';
			$ul = "<ul class=\"pt-3\">
			    <li>
				</li>
			</ul>";
			$html = $html.$ul;
			$html = $html.$this->widgetFooter();
		} else {
			$html = "<p>NO POSTS TODAY YET</p>";
		}

		wp_reset_postdata();

		echo htmlspecialchars_decode("<div class=\"saittech_ptalc_copy\">$html</div>
		<div class=\"\"><button class=\"btn btn-info saittech_ptalc_copy_clip\">COPY TO CLIP</button></div>");
	}

	/**
	 * Add a menu item for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function add_widget() {

		wp_add_dashboard_widget($this->plugin_name, 'Posts Titles and Links', function(){
			return $this->postsWidget();
		});

	}

}