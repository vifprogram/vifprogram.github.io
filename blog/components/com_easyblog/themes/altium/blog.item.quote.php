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
<!-- Post item wrapper -->
<div id="entry_<?php echo $row->id; ?>" class="blog-post micro-quote clearfix prel<?php echo (!empty($row->team)) ? ' teamblog-post' : '' ;?>" itemscope itemtype="http://schema.org/Blog">
	<div class="blog-post-in">

		<!-- Post metadata -->
		<?php echo $this->fetch( 'blog.meta.php' , array( 'row' => $row, 'postedText' => JText::_( 'COM_EASYBLOG_QUOTE_SHARED' ) , 'loadAdminTools' => true ) ); ?>

		<div class="blog-content clearfix">

			<!-- @ Trigger: onAfterDisplayTitle -->
			<?php echo $row->event->afterDisplayTitle; ?>

			<!-- Load social buttons -->
			<?php if( in_array( $system->config->get( 'main_socialbutton_position' ) , array( 'top' , 'left' , 'right' ) ) ){ ?>
				<?php echo EasyBlogHelper::showSocialButton( $row , true ); ?>
			<?php } ?>

			<div class="blog-text clearfix prel">
				<!-- Post quote-->
				<div class="blog-quote">
					<!-- Post title -->
					<h2 id="title-<?php echo $row->id; ?>" class="blog-title<?php echo ($row->isFeatured) ? ' featured' : '';?> rip" itemprop="name" itemprop="name">
						<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id='.$row->id); ?>" itemprop="url"><?php echo $row->title; ?></a>

						<?php if( $row->isFeatured ) { ?>
							<!-- Show a featured tag if the entry is featured -->
							<sup class="tag-featured"><?php echo Jtext::_('COM_EASYBLOG_FEATURED_FEATURED'); ?></sup>
						<?php } ?>
					</h2>

					<!-- Post content -->
					<div>
					<?php echo $row->text; ?>
					</div>
				</div>

				<!-- @ Trigger: onBeforeDisplayContent -->
				<?php echo $row->event->beforeDisplayContent; ?>

				<!-- the content -->
				<?php echo $row->text; ?>

				<!-- joomla content plugin call -->
				<?php echo $row->event->afterDisplayContent; ?>

				<?php /* content copyright */ ?>
				<?php if( $system->config->get( 'layout_copyrights' ) && !empty($row->copyrights) ) { ?>
				<div class="blog-copyrights mtm">
					<div class="in clearfix">
						<span class="blog-copyrights">
							<?php echo JText::_('COM_EASYBLOG_COPYRIGHTS_PREFIX') . $row->copyrights ?>
						</span>
					</div>
				</div>
				<?php } ?>

				<?php if( $system->config->get( 'main_locations_blog_frontpage' ) ){ ?>
				<?php echo EasyBlogHelper::getHelper( 'Maps' )->getHTML( true ,
																		$row->address,
																		$row->latitude ,
																		$row->longitude ,
																		$system->config->get( 'main_locations_blog_map_width') ,
																		$system->config->get( 'main_locations_blog_map_height' ),
																		JText::sprintf( 'COM_EASYBLOG_LOCATIONS_BLOG_POSTED_FROM' , $row->address ),
																		'post_map_canvas_' . $row->id );?>
				<?php } ?>
			</div>

			<?php if( $this->getParam( 'show_tags' ) && $this->getParam( 'show_tags_frontpage' , true ) ){ ?>
				<?php echo $this->fetch( 'tags.item.php' , array( 'tags' => $row->tags ) ); ?>
			<?php } ?>

			<!-- Load bottom social buttons -->
			<?php if( $system->config->get( 'main_socialbutton_position' ) == 'bottom' ){ ?>
				<?php echo EasyBlogHelper::showSocialButton( $row , true ); ?>
			<?php } ?>

			<!-- Standard facebook like button needs to be at the bottom -->
			<?php if( $system->config->get('main_facebook_like') && $system->config->get('main_facebook_like_layout') == 'standard' && $system->config->get( 'integrations_facebook_show_in_listing') ) : ?>
				<?php echo $this->fetch( 'facebook.standard.php' , array( 'facebook' => $row->facebookLike ) ); ?>
			<?php endif; ?>

			<?php if( $system->config->get( 'layout_showcomment' ) && EasyBlogHelper::getHelper( 'Comment')->isBuiltin() ){ ?>
				<!-- Recent comment listings on the frontpage -->
				<?php echo $this->fetch( 'blog.item.comment.list.php' , array( 'row' => $row ) ); ?>
			<?php } ?>

			<?php if( $this->getParam( 'show_last_modified' ) ){ ?>
				<!-- Modified date -->
				<span class="blog-modified-date">
					<?php echo JText::_( 'COM_EASYBLOG_LAST_MODIFIED' ); ?>
					<?php echo JText::_( 'COM_EASYBLOG_ON' ); ?>
					<time datetime="<?php echo $this->formatDate( '%Y-%m-%d' , $row->modified ); ?>">
						<span><?php echo $this->formatDate( $system->config->get('layout_dateformat') , $row->modified ); ?></span>
					</time>
				</span>
			<?php } ?>

			<!-- Post metadata -->
			<div class="blog-meta-bottom pts clearfix">
				<!--div class="clearfix" style="border-top:1px solid #ccc;background:#f5f5f5;padding:15px;margin:15px -15px -15px; vertical-align: middle;"-->
				<a class="blog-readmore" href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id='.$row->id); ?>">
					<span><?php echo JText::_('COM_EASYBLOG_CONTINUE_READING'); ?></span>
				</a>

					<div class="in-block">
						<?php if( $system->config->get( 'layout_avatar' ) && $this->getParam( 'show_avatar_frontpage' ) ){ ?>
						<!-- @template: Avatar -->
						<?php echo $this->fetch( 'blog.avatar.php' , array( 'row' => $row ) ); ?>
						<?php } ?>

						<?php if( $this->getParam( 'show_hits' , true ) ){ ?>
							<span class="blog-hit"><?php echo JText::sprintf( 'COM_EASYBLOG_HITS_TOTAL' , $row->hits ); ?></span>
						<?php } ?>

						<?php echo $this->fetch( 'blog.item.comment.php' , array( 'row' => $row) ); ?>

						<?php if( $system->config->get( 'main_ratings_frontpage' ) ) { ?>
						<!-- Blog ratings -->
						<?php echo $this->fetch( 'blog.rating.php' , array( 'row' => $row , 'locked' => $system->config->get( 'main_ratings_frontpage_locked' ) ) ); ?>
					<?php } ?>
					</div>
				<!--/div-->
			</div><!--/post metadata-->
		</div>
	</div>
</div>