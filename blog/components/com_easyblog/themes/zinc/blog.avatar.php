<?php
/**
* @package 		EasyBlog
* @copyright	Copyright (C) 2010 - 2013 Stack Ideas Sdn Bhd. All rights reserved.
* @license 		Proprietary Use License http://stackideas.com/licensing.html
* @author 		Stack Ideas Sdn Bhd
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );
?>
<!-- Avatar wrappers -->
<div class="blog-avatar" itemscope itemtype="http://schema.org/Person" itemprop="author">
	<?php if( isset( $row->team_id ) && $system->config->get('layout_teamavatar' ) ){ ?>
	<?php
			$teamBlog   = EasyBlogHelper::getTable( 'TeamBlog', 'Table');
			$teamBlog->load( $row->team_id );
	?>
		<!-- Team avatars -->
		<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=teamblog&layout=listings&id=' . $teamBlog->id ); ?>" class="avatar">
			<img src="<?php echo $teamBlog->getAvatar(); ?>" alt="<?php echo $teamBlog->title; ?>" class="avatar avatar-team" />
		</a>
		<a href="<?php echo $row->blogger->getProfileLink(); ?>" class="avatar">
			<img src="<?php echo $row->blogger->getAvatar(); ?>" alt="<?php echo $this->escape( $row->blogger->getName() ); ?>" itemprop="image" class="avatar avatar-author" />
		</a>
	<?php } else { ?>
		<a href="<?php echo $row->blogger->getProfileLink(); ?>" class="avatar">
			<img src="<?php echo $row->blogger->getAvatar(); ?>" alt="<?php echo $this->escape( $row->blogger->getName() ); ?>" class="avatar avatar-author" itemprop="image" />
		</a>
	<?php } ?>
</div>