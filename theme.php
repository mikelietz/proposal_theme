<?php

class CriticalHitTheme extends WaziTheme
{
	/**
	 * Load assets and add the CSS ones to the header on the template_stylesheet action hook.
	 * @return void
	 */
	public function action_template_header_10()
	{
		$assets = $this->load_assets();
		foreach($assets['less'] as $less) {
			Stack::add('template_stylesheet', array($less , 'screen,projection,print', array('rel' => 'stylesheet/less')));
		}
		Stack::add('template_footer_javascript', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', 'jquery');
	}

	public function action_theme_ui( $theme )
	{
		$ui = new FormUI( __CLASS__ );

		// Potential Static home page
		$page= $ui->append( 'select', 'page', 'criticalhit__home', _t('The page to show for the home page: ', 'staticfront') );
		$page->options['--none--']= _t('Show Normal Posts', 'staticfront');
		foreach( Posts::get( array( 'content_type' => Post::type('page'), 'nolimit' => 1 ) ) as $post ) {
			$page->options[$post->slug]= $post->title;
		}

		// Save
		$ui->append( 'submit', 'save', _t( 'Save' ) );
		$ui->set_option( 'success_message', _t( 'Options saved' ) );
		$ui->out();
	}

	public function filter_theme_act_display_home( $handled, $theme )
	{
		$vars = Controller::get_handler_vars();
		if(empty($vars['page'])) {
			$page = Options::get( 'criticalhit__home' );
			if ( $page && $page != '--none--' ) {
				$post= Post::get( array( 'slug' => $page ) );
				$theme->act_display( array( 'posts' => $post ) );
				return true;
			}
		}
		return false;
	}


}
