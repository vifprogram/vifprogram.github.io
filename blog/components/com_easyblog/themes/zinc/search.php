<?php
/**
* @package		EasyBlog
* @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
</script>
<div id="ezblog-body">
	<div id="ezblog-section">
		<span><?php echo JText::_('COM_EASYBLOG_SEARCH_HEADING_TITLE'); ?></span>
	</div>
	<div id="eblog-search" class="mtm prel">
		<form name="search-form" method="get" action="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog&view=search&layout=parsequery' );?>">

			<div class="input-group">
				<input type="text" class="form-control" name="query" value="<?php echo !empty( $query ) ? $this->escape( $query ) : JText::_( 'COM_EASYBLOG_SEARCH_DEFAULT' ); ?>" onfocus="if( this.value == '<?php echo JText::_( 'COM_EASYBLOG_SEARCH_DEFAULT' );?>' ){ this.value =''; }" onblur="if (this.value == '') {this.value = '<?php echo JText::_( 'COM_EASYBLOG_SEARCH_DEFAULT' );?>';}" />
				<span class="input-group-btn">
					<button type="submit" class="butt butt-default"><?php echo JText::_('COM_EASYBLOG_SEARCH_BUTTON'); ?></button>
				</span>
			</div>


			<?php if( EasyBlogHelper::getJConfig()->get( 'sef' ) != 1 ){ ?>
			<input type="hidden" name="option" value="com_easyblog" />
			<input type="hidden" name="view" value="search" />
			<input type="hidden" name="layout" value="parsequery" />
			<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
			<?php } ?>
		</form>
	</div>
	<div id="eblog-search-result">
		<?php if( $query ){ ?>
			<?php if( $posts ){ ?>
				<div class="eblog-message info"><?php echo JText::sprintf('COM_EASYBLOG_SEARCH_RESULTS_KEYWORD' , $pagination->total , $query ); ?></div>
				<?php echo $this->fetch( 'blog.search.item.php' ); ?>
			<?php } else { ?>
				<div class="eblog-message warning"><?php echo JText::sprintf('COM_EASYBLOG_SEARCH_RESULTS_KEYWORD' , 0 , $query ); ?></div>
			<?php } ?>
		<?php } ?>
	</div>
</div>