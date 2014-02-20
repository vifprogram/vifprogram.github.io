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

// $extraClass     = 'blog-meta';

// Altium
// If view is entry, use 'fsm'
// If view is latest or other, use mbm
// if type is micro use micro , else twitter or email

// Default
// If view is not entry use 'mbm'
// If view is not entry and microtype use class 'micro'
// If twitter use 'twitter'
?>
<?php if( $this->getParam( 'show_author') || $this->getParam( 'show_created_date') || $this->getParam( 'show_category') ) { ?>
<div>
	<?php if( $this->getParam( 'show_author') ){ ?>
	<!-- Author information -->
	<span class="blog-author">
		<?php echo $postedText; ?>
		<?php echo JText::_( 'COM_EASYBLOG_BY' );?>
		<a href="<?php echo $row->blogger->getProfileLink(); ?>" itemprop="author"><?php echo $row->blogger->getName(); ?></a>
	</span>
	<?php } ?>

	<?php if( $this->getParam( 'show_created_date' ) ){ ?>
		<!-- Creation date -->
		<span class="blog-created">
			<?php echo JText::_( 'COM_EASYBLOG_ON' ); ?>
			<time datetime="<?php echo $this->formatDate( '%Y-%m-%d' , $row->{$this->getParam( 'creation_source')} ); ?>">
				<span><?php echo $this->formatDate( $system->config->get('layout_dateformat') , $row->{$this->getParam( 'creation_source')} ); ?></span>
			</time>
		</span>
	<?php } ?>

	<?php if( $this->getParam( 'show_category' ) ){ ?>
		<!-- Category info -->
		<span class="blog-category">
			<?php $categoryName   = isset($row->category) ? $row->category : $row->getCategoryName(); ?>
			<?php echo JText::sprintf( 'COM_EASYBLOG_IN' , EasyBlogRouter::_('index.php?option=com_easyblog&view=categories&layout=listings&id=' . $row->category_id ), $categoryName ); ?>
		</span>
	<?php } ?>
</div>
<hr style="margin: 8px 0;">
<div>
	<span class="float-r">
		<?php echo $this->fetch( 'blog.read.fontsize.php' ); ?>
	</span>
	<?php if( $this->getParam( 'show_category' ) ){ ?>
		<!-- Category info -->
		<span>
			<i class="i-folder-open"></i>
			<?php $categoryName   = isset($row->category) ? $row->category : $row->getCategoryName(); ?>
			
			<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=categories&layout=listings&id=' . $row->category_id ); ?>">
				<?php echo $categoryName; ?>
			</a>
		</span>
	<?php } ?>

	<?php if( $system->config->get('main_comment') && $blog->totalComments !== false && $this->getParam( 'show_comments' ) ){ ?>
		<span style="margin-left: 20px">
			<i class="i-comments"></i>
			<?php if( $system->config->get('comment_disqus') ) { ?>
				<?php echo $blog->totalComments; ?>
			<?php } else { ?>
				<a href="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog&view=entry&id=' . $blog->id ); ?>#comments"><?php echo $this->getNouns( 'COM_EASYBLOG_COMMENT_COUNT' , $blog->totalComments , true ); ?></a>
			<?php } ?>
		</span>
	<?php } ?>

	<?php if( $this->getParam( 'show_hits' , true ) ){ ?>
		<span style="margin-left: 20px">
			<i class="i-eye-open"></i>
			<span><?php echo JText::sprintf( 'COM_EASYBLOG_HITS_TOTAL' , $blog->hits ); ?></span>
		</span>
	<?php } ?>
</div>
<?php } ?>