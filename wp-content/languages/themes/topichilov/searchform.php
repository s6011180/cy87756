<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>" >
<div><label class="screen-reader-text" for="s"><?php __('Search for:'); ?></label>
    <input type="text" onblur="if (this.value == '') {this.value = 'поиск';}" onfocus="if (this.value == 'поиск') {this.value = '';}" value="поиск" value="<?php echo $a = get_search_query() ? get_search_query() : 'поиск'; ?>" name="s" id="s" />
<input type="submit" id="searchsubmit" value="Найти" />
</div>
</form>