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
<div id="ezblog-body">
	<div id="ezblog-section">
		<span><?php echo JText::_('COM_EASYBLOG_TEAMBLOG_PAGE_HEADING'); ?></span>
	</div>

	<div id="ezblog-teamblog" class="list-media">
		<?php foreach($teams as $row) { ?>
		<div class="media">
			<?php if($system->config->get('layout_teamavatar', true)) : ?>
			<div class="pull-left">
				<a href="<?php echo  EasyBlogRouter::_('index.php?option=com_easyblog&view=teamblog&layout=listings&id='.$row->id);?>" class="media-avatar">
					<img src="<?php echo $row->avatar; ?>" alt="<?php echo $this->escape( $row->title ); ?>" class="avatar" />
				</a>
			</div><!--/.pull-left-->
			<?php endif; ?>

			<div class="media-body">
				<h3 class="media-title reset-h mbm">
					<a href="<?php echo  EasyBlogRouter::_('index.php?option=com_easyblog&view=teamblog&layout=listings&id='.$row->id);?>"><?php echo $row->title;?></a>
					<?php if ($row->isFeatured) : ?><small>&nbsp; <?php echo JText::_( 'COM_EASYBLOG_FEATURED_TEAMBLOG_FEATURED' );?></small><?php endif; ?>
				</h3>

				

				<div class="media-desc">
					<?php if ($row->isActualMember && $system->my->id != 0) { ?>
					<div class="media-leave mbl">
						<?php echo JText::_( 'COM_EASYBLOG_CURRENTLY_MEMBER_OF_THE_TEAM' );?>
						<a class="link-jointeam" href="javascript:eblog.teamblog.leave('<?php echo $row->id;?>');"><?php echo JText::_( 'COM_EASYBLOG_TEAMBLOG_LEAVE_TEAM' );?>?</a>
					</div>
					<?php } ?>

					<?php if(! empty( $row->description )) : ?>
					<?php 	echo nl2br($row->description); ?>
					<?php endif; ?>

					<?php if( $row->access != EBLOG_TEAMBLOG_ACCESS_MEMBER || $row->isMember || EasyBloghelper::isSiteAdmin() && ($system->config->get('main_teamsubscription')) ){ ?>
							<a class="butt butt-default butt-subscribe" href="javascript:eblog.subscription.show('<?php echo EBLOG_SUBSCRIPTION_TEAMBLOG; ?>','<?php echo $row->id;?>');">
								<?php echo JText::_('COM_EASYBLOG_SUBSCRIBE_TEAM'); ?>
							</a>
					<?php } ?>

					<?php if( ($row->access != EBLOG_TEAMBLOG_ACCESS_MEMBER || $row->isMember || EasyBloghelper::isSiteAdmin() ) && ($system->config->get('main_rss')) ){ ?>
							<a class="butt butt-default butt-rss" href="<?php echo  EasyBlogHelper::getHelper( 'Feeds' )->getFeedURL( 'index.php?option=com_easyblog&view=teamblog&id=' . $row->id );?>" title="<?php echo JText::_('COM_EASYBLOG_SUBSCRIBE_FEEDS'); ?>">
								<?php echo JText::_('COM_EASYBLOG_SUBSCRIBE_FEEDS'); ?>
							</a>
					<?php } ?>

					<?php if( $system->config->get( 'teamblog_allow_join' ) ){ ?>
						<?php if( !$row->isMember && $system->my->id != 0 ) { ?>
								<a class="butt butt-default butt-jointeam" href="javascript:eblog.teamblog.join('<?php echo $row->id;?>');">
									<?php echo JText::_( 'COM_EASYBLOG_TEAMBLOG_JOIN_TEAM' );?>
								</a>
						<?php } ?>
					<?php } ?>

					<?php if( $system->admin ) : ?>
						<?php if ($row->isFeatured) { ?>
							<a class="feature-del" href="javascript:eblog.featured.remove('teamblog','<?php echo $row->id;?>');" title="<?php echo Jtext::_('COM_EASYBLOG_FEATURED_FEATURE_REMOVE_TEAM'); ?>">
								<?php echo Jtext::_('COM_EASYBLOG_FEATURED_FEATURE_REMOVE_TEAM'); ?>
							</a>
						<?php } else { ?>
							<a class="feature-add" href="javascript:eblog.featured.add('teamblog','<?php echo $row->id;?>');" title="<?php echo Jtext::_('COM_EASYBLOG_FEATURED_FEATURE_THIS_TEAM'); ?>">
								<?php echo Jtext::_('COM_EASYBLOG_FEATURED_FEATURE_THIS_TEAM'); ?>
							</a>
						<?php } ?>
					<?php endif; ?>
				</div>




				<?php if( $this->getParam( 'show_teamblogstatsitem') ) { ?>
				<div class="media-related">
					<ul class="media-tabs reset-ul float-li clearfix">
						<li class="active">
							<a href="#tab-posts-<?php echo $row->id; ?>" data-foundry-toggle="tab" class="butt">
								<i class="i-pencil"></i>
								<b><?php echo JText::_( 'COM_EASYBLOG_TEAMBLOGS_POSTS' );?></b> 
								<span class="muted">&nbsp; <?php echo $row->totalEntries; ?></span>
							</a>
						</li>
						<?php if(count($row->categories) > 0) : ?>
						<li>
							<a href="#tab-categories-<?php echo $row->id; ?>" data-foundry-toggle="tab" class="butt">
								<i class="i-folder-open"></i>
								<b><?php echo JText::_( 'COM_EASYBLOG_TEAMBLOGS_CATEGORIES' );?></b>
								<span class="muted">&nbsp; <?php echo count( $row->categories );?></span>
							</a>
						</li>
						<?php endif; ?>
						<?php if( $row->tags ) : ?>
						<li>
							<a href="#tab-tags-<?php echo $row->id; ?>" data-foundry-toggle="tab" class="butt">
								<i class="i-tags"></i>
								<b><?php echo JText::_( 'COM_EASYBLOG_TEAMBLOGS_TAGS' );?></b>
								<span class="muted">&nbsp; <?php echo count( $row->tags );?></span>
							</a>
						</li>
						<?php endif; ?>
					</ul>

					<div class="tab-content">
						<div class="tab-pane fade active in" id="tab-posts-<?php echo $row->id; ?>">
							<div class="media-story">
								<?php if( $row->access == EBLOG_TEAMBLOG_ACCESS_MEMBER && !$row->isMember && !EasyBlogHelper::isSiteAdmin() ){?>
								<div class="media-restricted">
									<?php echo JText::_('COM_EASYBLOG_TEAMBLOG_MEMBERS_ONLY'); ?>
									<?php echo ($system->my->id != 0) ? JText::sprintf('COM_EASYBLOG_TEAMBLOG_CLICK_TO_JOIN', 'eblog.teamblog.join('.$row->id.')') : '' ; ?>
								</div>
								<?php } else { ?>

								<?php if(empty($row->blogs)) { ?>
								<div><?php echo JText::_('COM_EASYBLOG_NO_POST_IN_TEAM'); ?></div>
								<?php }else{ ?>

								<ul class="media-updates reset-ul">
									<?php foreach( $row->blogs as $entry ) { ?>
										<?php echo $this->fetch( 'blog.item.simple'. EasyBlogHelper::getHelper( 'Sources' )->getTemplateFile( $entry->source ) . '.php' , array( 'entry' => $entry , 'customClass' => 'team' )); ?>
									<?php } ?>
								</ul>
								<?php } //end if else ?>
							<?php } //end if else ?>
							</div>
						</div>

						<?php if(count($row->categories) > 0) : ?>
						<div class="tab-pane fade" id="tab-categories-<?php echo $row->id; ?>">
							<?php for($i = 0; $i < count($row->categories); $i++) : ?>
							<a class="butt butt-default butt-s" href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=teamblog&layout=statistic&id='.$row->id. '&stat=category&catid='.$row->categories[$i]->id); ?>">
								<?php echo $row->categories[$i]->title; ?>
								<span class="muted">&nbsp; <?php echo $row->categories[$i]->post_count;?></span>
							</a>
							<?php endfor; ?>
						</div>
						<?php endif; ?>

						<?php if( $row->tags ) : ?>
						<div class="tab-pane fade" id="tab-tags-<?php echo $row->id; ?>">
							<?php
							foreach( $row->tags as $tag )
							{
							?>
								<a class="butt butt-default butt-s" href="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog&view=teamblog&layout=statistic&id=' . $row->id . '&stat=tag&&tagid=' . $tag->id );?>">
									<?php echo $tag->title; ?>
								</a>
							<?php
							}
							?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php } // end stat item ?>


				<div class="media-authors">
					<div class="mbl">
						<b><?php echo JText::_( 'COM_EASYBLOG_TEMBLOG_CONTRIBUTORS' );?></b>
						<span class="muted">&nbsp; <?php echo count( $row->members );?></span>
					</div>
					<ul class="active-bloggers clearfix reset-ul float-li<?php echo ( $system->config->get('layout_avatar') ) ? '' : ' no-avatar'; ?>">
						<?php
							if(! empty($row->members))
							{
								foreach($row->members as $member)
								{
						 ?>
						<li>
							<a href="<?php echo $member->getProfileLink(); ?>" title="<?php echo $member->displayName; ?>">
							<?php if ( $system->config->get('layout_avatar') ) { ?>
								<img src="<?php echo $member->getAvatar(); ?>" alt="<?php echo $member->displayName; ?>" title="<?php echo $member->displayName;?>" class="avatar float-l mrm"/>
							<?php echo EasyBlogTooltipHelper::getBloggerHTML( $member->id, array('my'=>'left bottom','at'=>'left top','of'=>array('traverseUsing'=>'prev')) ); ?>
							<?php } ?>
							</a>
						</li>
						 <?php
								}
							}
						?>
					</ul>
				</div>
			</div>
		</div>
		<?php } //end foreach ?>

		<?php if(count($teams) <= 0) { ?>
		<div><?php echo JText::_('COM_EASYBLOG_NO_RECORDS_FOUND'); ?></div>
		<?php } ?>

		<div class="eblog-pagination">
			<?php echo $pagination; ?>
		</div>
	</div>
</div>
