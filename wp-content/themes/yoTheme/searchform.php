				    <form method="get" id="search" action="<?php echo home_url(); ?>">
					<?php $req='';?>
               		<input type="text" value="<?php _e('Search this site', 'yotheme'); ?>" name="s" id="s" class="s sprite" onfocus="hiddSearchWord('s')" onblur="showSearchWord('s');this.value='<?php _e('Search this site', 'yotheme'); ?>';" tabindex="4" <?php if ($req) echo "aria-required='true'"; ?> />
               		<input type="submit" id="searchsubmit" value="" />
               		</form>