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
$mainframe	= JFactory::getApplication();
?>
<div id="ezblog-body">
	<div id="ezblog-section"><?php echo JText::_('COM_EASYBLOG_CATEGORIES_PAGE_HEADING'); ?></div>

	<div id="ezblog-categories" class="list-media">
		<?php foreach($data as $category) { ?>
		<div class="media">
			<?php if($system->config->get('layout_categoryavatar', true)) : ?>
			<div class="pull-left">
				<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=categories&layout=listings&id='.$category->id); ?>" class="media-avatar">
					<img src="<?php echo $category->avatar;?>" alt="<?php echo JText::_( $category->title ); ?>" class="avatar" />
				</a>
			</div><!--/.pull-left-->
			<?php endif; ?>

			<div class="media-body">
				<h3 class="media-title reset-h mbm">
					<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=categories&layout=listings&id='.$category->id); ?>"><?php echo JText::_( $category->title ); ?></a>
				</h3>
				
				<div class="media-desc">
					<?php if ( $category->description ) { ?>
					<?php echo $category->description; ?>
					<?php } ?>

					<?php if($system->config->get('main_categorysubscription')) { ?>
					<?php if( ($category->private && $system->my->id != 0 ) || ($system->my->id == 0 && $system->config->get( 'main_allowguestsubscribe' )) || $system->my->id != 0) : ?>
						<a href="javascript:eblog.subscription.show( '<?php echo EBLOG_SUBSCRIPTION_CATEGORY; ?>' , '<?php echo $category->id;?>');" title="<?php echo JText::_('COM_EASYBLOG_SUBSCRIPTION_SUBSCRIBE_CATEGORY'); ?>" class="butt butt-default">
							<?php echo JText::_('COM_EASYBLOG_SUBSCRIPTION_SUBSCRIBE_CATEGORY'); ?>
						</a>
					<?php endif; ?>
					<?php } ?>
					<?php if( $system->config->get('main_rss') ){ ?>
						<a href="<?php echo $category->rssLink;?>" title="<?php echo JText::_('COM_EASYBLOG_SUBSCRIBE_FEEDS'); ?>" class="butt butt-default butt-rss">
							<?php echo JText::_('COM_EASYBLOG_SUBSCRIBE_FEEDS'); ?>
						</a>
					<?php } ?>
				</div>


				<?php if(! empty($category->nestedLink)) { ?>
				<div class="media-childs">
					<span><?php echo JText::_( 'COM_EASYBLOG_CATEGORIES_SUBCATEGORIES' ); ?></span>
					<?php echo $category->nestedLink; ?>
				</div>
				<?php } ?>


				<?php if( $this->getParam( 'show_categorystatsitem') ) { ?>
				<div class="media-story">
					<div class="mbl">
						<b>Posts</b>
						<span class="muted">&nbsp; <?php echo $category->cnt; ?></span>
					</div>
					<?php if(empty($category->blogs)) { ?>
						<div><?php echo JText::_('COM_EASYBLOG_CATEGORIES_NO_POST_YET'); ?></div>
					<?php } else { ?>

					<ul class="media-updates reset-ul">
						<?php foreach( $category->blogs as $entry ) { ?>
							<?php echo $this->fetch( 'blog.item.simple'. EasyBlogHelper::getHelper( 'Sources' )->getTemplateFile( $entry->source ) . '.php' , array( 'entry' => $entry , 'customClass' => 'category' )); ?>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>
				<?php } // if for statistic items ?>


				<?php if( $system->isBloggerMode === false && $category->blogs ) : ?>
				<div class="media-authors">
					<div class="mbl">
						<b><?php echo JText::_( 'COM_EASYBLOG_CATEGORIES_ACTIVE_BLOGGERS' );?></b>
						<span class="muted">&nbsp; <?php echo ( $category->bloggers  ) ? count( $category->bloggers ) : '0' ;?></span>
					</div>

					<?php
					$initialLimit = ($mainframe->getCfg('list_limit') == 0) ? 5 : $mainframe->getCfg('list_limit');
					if( $this->getParam( 'show_category_bloggers_avatar') ){
					?>
					<ul class="active-bloggers clearfix reset-ul float-li<?php echo ( $system->config->get('layout_avatar') ) ? '' : ' no-avatar'; ?>">
						<?php
							$initialLimit = ($mainframe->getCfg('list_limit') == 0) ? 5 : $mainframe->getCfg('list_limit');

							if( !empty( $category->bloggers ) )
							{
								$i = 1;
								// Repeat this to simulate blogger data
								// $category->bloggers[] = $category->bloggers[0];
								foreach($category->bloggers as $member )
								{
						 ?>
						<li class="<?php if ($i > $initialLimit) { ?> more-activebloggers<?php } ?>"<?php if ($i > $initialLimit) { ?> style="display: none;"<?php } ?>>
							
							<?php if ( $system->config->get('layout_avatar') ) { ?>
							<a href="<?php echo $member->getProfileLink(); ?>" title="<?php echo $member->getName(); ?>" class="avatar mrm">
								<img <?php if ($i <= $initialLimit) { ?> src="<?php echo $member->getAvatar(); ?>" <?php } else { ?> data-src="<?php echo $member->getAvatar(); ?>" <?php } ?> alt="<?php echo $member->getName(); ?>" class="avatar"/>
							</a>
							<?php } else { ?>
							<a href="<?php echo $member->getProfileLink(); ?>" title="<?php echo $member->getName(); ?>" class="avatar">
								<?php echo $member->getName(); ?>
							</a>
							<?php } ?>
							
						</li>
						 <?php
								$i++;
								}
							}
						?>
					</ul>
					<?php } ?>
						<?php
							if( !empty( $category->bloggers ) )
							{
								if (count($category->bloggers) > $initialLimit) {
						?>
                                <script type="text/javascript">
                                    EasyBlog.ready(function($){
                                        $(".showAllBloggers").click(function(){

                                            $('.more-activebloggers')
                                                .each(function() {
                                                    $(this).find('.avatar')
                                                        .attr('src', $(this).find('.avatar').attr('data-src'));
                                                })
                                                .show();

                                            $(this).remove();
                                        });
                                    });
                                </script>
                                <a class="pts showAllBloggers" style="display: inline-block;" href="javascript: void(0);"><?php echo JText::sprintf('COM_EASYBLOG_SHOW_ALL_BLOGGERS', count($category->bloggers)); ?> &raquo;</a>
						<?php
								}
							}
						?>
				</div>
				<?php endif; ?>
			</div><!--/.media-body-->
		</div><!--/.media-->
		<?php } //end foreach ?>
	</div><!--/.list-media-->

	<?php if(count($data) <= 0) { ?>
		<div><?php echo JText::_('COM_EASYBLOG_NO_RECORDS_FOUND'); ?></div>
	<?php } ?>

	<?php if ( $pagination ) : ?>
		<div class="pagination clearfix">
			<?php echo $pagination; ?>
		</div>
	<?php endif; ?>
</div><!--end: #ezblog-body-->
