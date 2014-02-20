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
<li class="post<?php echo isset( $customClass ) ? ' item-' . $customClass : '';?><?php if( $entry->isFeatured ) { ?> post-featured<?php } ?>" itemscope itemtype="http://schema.org/Blog">
	<div>
		<i class="i-link<?php if( $entry->isFeatured ) { ?> post-featured<?php } ?>"<?php if( $entry->isFeatured ) { ?> title="<?php echo Jtext::_('COM_EASYBLOG_FEATURED_FEATURED'); ?>"<?php } ?>></i>
		<?php echo $this->formatDate( 'M d' , $entry->{$this->getParam( 'creation_source')} ); ?>
	</div>
	<div>
		<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id=' . $entry->id ); ?>" itemprop="url"><?php echo $entry->title; ?></a>
	</div>
</li>