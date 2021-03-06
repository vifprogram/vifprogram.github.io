<?php
/**
 * @package		EasyBlog
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php if( $system->config->get('main_comment') && $this->getParam( 'show_comments' ) ) { ?>
	<span class="blog-comment<?php echo isset( $customClass ) ? ' ' . $customClass : '';?>">
		<i class="i-comments"></i>
		<?php if( $system->config->get('comment_disqus') ) { ?>
			<?php echo $row->totalComments; ?>
		<?php } else { ?>
			<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id='.$row->id); ?>#comments"><?php echo $row->totalComments; ?></a>
		<?php } ?>
	</span>
<?php } ?>