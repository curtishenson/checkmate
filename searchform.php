<form id="searchform" method="get" action="<?php bloginfo('url'); ?>/">
	<fieldset>
		<label for="input_search"><?php _e('Search', 'checkmate'); ?></label>
		<input value="" name="s" id="input_search" type="text" />
		<input type="hidden" id="searchsubmit" />
	</fieldset>
</form>