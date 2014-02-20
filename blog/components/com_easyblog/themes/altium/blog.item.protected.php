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
<div id="entry_<?php echo $row->id; ?>" class="blog-post clearfix prel<?php echo (!empty($row->team)) ? ' teamblog-post' : '' ;?>">
	<div class="blog-post-in">

		<?php if( $this->getParam( 'show_author' , true ) || $this->getParam( 'show_created_date' , true ) ){ ?>
		<div class="blog-meta micro mbm">
			<!-- @template: Admin tools -->
			<?php echo $this->fetch( 'blog.admin.tool.php' , array( 'row' => $row ) ); ?>

			<?php if( $this->getParam( 'show_author') ){ ?>
				<!-- Author information -->
				<span class="blog-author">
					<?php echo JText::_( 'COM_EASYBLOG_POSTED_BY' );?>
					<a href="<?php echo $row->blogger->getProfileLink(); ?>"><?php echo $row->blogger->getName(); ?></a>
				</span>
			<?php } ?>

			<?php if( $this->getParam( 'show_created_date' ) ){ ?>
				<!-- Creation date -->
				<span class="blog-created">
					<?php echo JText::_( 'COM_EASYBLOG_ON' ); ?>
					<span><?php echo $this->formatDate( $system->config->get('layout_dateformat') , $row->created ); ?></span>
				</span>
			<?php } ?>

			<?php if( $this->getParam( 'show_category' ) ){ ?>
				<!-- Category info -->
				<span class="blog-category">
					<?php echo JText::sprintf( 'COM_EASYBLOG_IN' , EasyBlogRouter::_('index.php?option=com_easyblog&view=categories&layout=listings&id=' . $row->category_id ), $row->category ); ?>
				</span>
			<?php } ?>
		</div>
		<?php } ?>

		<div class="blog-content clearfix">
			<!-- the title -->
			<h2 id="title_<?php echo $row->id; ?>" class="blog-title<?php echo ($row->isFeatured) ? ' featured' : '';?> rip mbs">
				<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id='.$row->id); ?>"><?php echo $row->title; ?></a>
				<?php if( $row->isFeatured ) { ?>
					<sup class="tag-featured"><?php echo Jtext::_('COM_EASYBLOG_FEATURED_FEATURED'); ?></sup>
				<?php } ?>
			</h2>

			<div class="blog-text clearfix prel">
				<div id="ezblog-protected">
					<?php if(!empty($errmsg)) :?>
					<div class="eblog-message warning"><?php echo $errmsg; ?></div>
					<?php endif;?>

					<div id="blog-protected">
						<form method="post" action="index.php">
							<div class="eblog-message warning"><?php echo JText::_('COM_EASYBLOG_PASSWORD_PROTECTED_BLOG_AUTHENTICATION_REQUIRE'); ?></div>
							<div class="blog-password-inst small"><?php echo JText::_('COM_EASYBLOG_PASSWORD_PROTECTED_BLOG_AUTHENTICATION_INSTRUCTION'); ?></div>

							<div class="blog-password-input ptm">
								<input type="password" name="blogpassword_<?php echo $row->id; ?>" id="blogpassword_<?php echo $row->id; ?>" value="">
								<input type="submit" value="<?php echo JText::_('COM_EASYBLOG_PASSWORD_PROTECTED_BLOG_READ');?>">
								<input type="hidden" name="option" value="com_easyblog">
								<input type="hidden" name="controller" value="entry">
								<input type="hidden" name="task" value="setProtectedCredentials">
								<input type="hidden" name="id" value="<?php echo $row->id; ?>">
								<input type="hidden" name="return" value="<?php echo base64_encode( EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id='.$row->id, false) ); ?>">
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Post metadata -->
			<div class="blog-meta-bottom pts clearfix">
				<div class="in-block">
					<?php if( $system->config->get( 'layout_avatar' ) && $this->getParam( 'show_avatar_frontpage' ) ){ ?>
					<!-- @template: Avatar -->
					<?php echo $this->fetch( 'blog.avatar.php' , array( 'row' => $row ) ); ?>
					<?php } ?>

					<?php if( $this->getParam( 'show_hits' , true ) ){ ?>
						<span class="blog-hit"><?php echo JText::sprintf( 'COM_EASYBLOG_HITS_TOTAL' , $row->hits ); ?></span>
					<?php } ?>

					<?php echo $this->fetch( 'blog.item.comment.php' , array( 'row' => $row ) ); ?>

				</div>
			</div><!--/post metadata-->
		</div>
	</div>
</div>
