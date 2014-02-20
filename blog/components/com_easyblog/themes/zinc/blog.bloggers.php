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
	<?php if( $this->getParam( 'show_blogger_filterbar') ){ ?>
		<!-- Filtering and search form that appears at the top of the bloggers page -->
		<?php echo $this->fetch( 'blog.bloggers.search.php' , array( 'search' => $search ) ); ?>
	<?php } ?>

	<div id="ezblog-section"><?php echo JText::_('COM_EASYBLOG_BLOGGERS_PAGE_HEADING'); ?></div>
	
	<div id="ezblog-bloggers" class="list-media">
		<?php foreach($data as $row) { ?>

			<div class="media<?php echo ( $row->blogger->isFeatured() ) ? ' featured-blogger' : ''; ?> ">
				<?php if ( $system->config->get('layout_avatar') ){ ?>
				<div class="pull-left">
					<a href="<?php echo $row->blogger->getProfileLink(); ?>" class="media-avatar">
						<img src="<?php echo $row->blogger->getAvatar(); ?>" alt="<?php echo $row->blogger->getName(); ?>" class="avatar" />
					</a>

					<?php if( $this->getParam( 'show_bloggerstats') ) { ?>
					<ul class="profile-stats reset-ul">
						<?php if ( EasyBlogHelper::getHelper( 'Messaging' )->getHTML( $row->id ) ) : ?>
						<li>
							<?php echo EasyBlogHelper::getHelper( 'Messaging' )->getHTML( $row->id ); ?>
						</li>
						<?php endif; ?>
						<?php if ( !empty( $row->twitterLink ) ) : ?>
						<li>
							<a class="link-twitter" href="<?php echo $row->twitterLink; ?>" title="<?php echo JText::_('COM_EASYBLOG_INTEGRATIONS_TWITTER_FOLLOW_ME'); ?>">
								<?php echo JText::_('COM_EASYBLOG_INTEGRATIONS_TWITTER_FOLLOW_ME'); ?>
							</a>
						</li>
						<?php endif; ?>

						<?php if( $system->admin ){ ?>
						<?php if( $row->blogger->isFeatured() ) { ?>
						<li>
							<a href="javascript:eblog.featured.remove('blogger','<?php echo $row->id;?>');"  <?php echo ($row->blogger->isFeatured() ) ? '' : 'style="display:none;"';?> class="feature-del">
								<?php echo Jtext::_('COM_EASYBLOG_FEATURED_FEATURE_REMOVE'); ?>
							</a>
						</li>
						<?php } else { ?>
						<li>
							<a href="javascript:eblog.featured.add('blogger','<?php echo $row->id;?>');" <?php echo ($row->blogger->isFeatured() ) ? 'style="display:none;"' : '';?> class="feature-add">
								<?php echo Jtext::_('COM_EASYBLOG_FEATURED_FEATURE_THIS'); ?>
							</a>
						</li>
						<?php } ?>
						<?php } ?>
					</ul>
					<?php } ?>
				</div><!--/.pull-left-->
				<?php } ?>

				<div class="media-body">
					<h3 class="media-title reset-h mbm">
						<a href="<?php echo $row->blogger->getProfileLink(); ?>"><?php echo $row->blogger->getName(); ?></a>
						<?php if ($row->blogger->isFeatured() ){ ?>
						<small class="media-featured">&nbsp; <?php echo JText::_( 'COM_EASYBLOG_FEATURED_BLOGGER_FEATURED' );?></small>
						<?php } ?>
					</h3>

					<div class="media-desc">
						<?php if( $row->blogger->getBiography() ){ ?>
							<div class="mbl"><?php echo $row->blogger->getBiography(); ?></div>
						<?php } ?>

						<?php if( $system->config->get('main_bloggersubscription') ) { ?>
							<a class="butt butt-default butt-subscribe" href="javascript:void(0);" onclick="eblog.subscription.show( '<?php echo EBLOG_SUBSCRIPTION_BLOGGER; ?>' , '<?php echo $row->id;?>');">
								<?php echo JText::_('COM_EASYBLOG_SUBSCRIPTION_SUBSCRIBE_TO_BLOGGER'); ?>
							</a>
						<?php } ?>
					
						<?php if( $system->config->get('main_rss') ) { ?>
							<a class="butt butt-default butt-rss" href="<?php echo $row->rssLink;?>">
								<?php echo JText::_('COM_EASYBLOG_SUBSCRIBE_FEEDS'); ?>
							</a>
						<?php } ?>
					</div>

					<?php if( $row->blogger->getWebsite() != '' ){ ?>
					<div class="media-url">
						<a href="<?php echo $this->escape( $row->blogger->getWebsite() );?>" target="_blank" class="link-website">
							<?php echo $this->escape( $row->blogger->getWebsite() );?>
						</a>
					</div>
					<?php } ?>
				

					<?php if( $this->getParam( 'show_bloggerstatsitem') ) { ?>
					<div class="media-related">
						<ul class="media-tabs reset-ul float-li clearfix">
							<li class="active">
								<a href="#tab-posts-<?php echo $row->id; ?>" data-foundry-toggle="tab" class="butt">
									<i class="i-pencil"></i>
									<b><?php echo JText::_( 'COM_EASYBLOG_BLOGGERS_TOTAL_POSTS' );?></b> 
									<span class="muted">&nbsp; <?php echo $row->blogCount; ?></span>
								</a>
							</li>

							<?php if(count($row->categories) > 0) : ?>
							<li>
								<a href="#tab-categories-<?php echo $row->id; ?>" data-foundry-toggle="tab" class="butt">
									<i class="i-folder-open"></i>
									<b><?php echo JText::_( 'COM_EASYBLOG_BLOGGERS_TOTAL_CATEGORIES' );?></b>
									<span class="muted">&nbsp; <?php echo count($row->categories); ?></span>
								</a>
							</li>
							<?php endif; ?>

							<?php if( $row->tags ) : ?>
							<li>
								<a href="#tab-tags-<?php echo $row->id; ?>" data-foundry-toggle="tab" class="butt">
									<i class="i-tags"></i>
									<b><?php echo JText::_( 'COM_EASYBLOG_BLOGGERS_TAGS' );?></b>
									<span class="muted">&nbsp; <?php echo count( $row->tags );?></span>
								</a>
							</li>
							<?php endif; ?>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tab-posts-<?php echo $row->id; ?>">
								<div class="media-story">
									<?php if( !empty( $row->blogs ) ) { ?>
									<ul class="media-updates reset-ul">
										<?php foreach( $row->blogs as $entry ){ ?>
											<?php if( $system->config->get( 'main_password_protect' ) && !empty( $entry->blogpassword ) ){ ?>
												<!-- Password protected theme files -->
												<?php echo $this->fetch( 'blog.bloggers.protected.php' , array( 'entry' => $entry ) ); ?>
											<?php } else { ?>
												<!-- Normal post theme files -->
												<?php echo $this->fetch( 'blog.item.simple'. EasyBlogHelper::getHelper( 'Sources' )->getTemplateFile( $entry->source ) . '.php' , array( 'entry' => $entry , 'customClass' => 'blogger' ) ); ?>
											<?php } ?>

										<?php } ?>
									</ul>
									<?php } else { ?>
									<div><?php echo JText::sprintf('COM_EASYBLOG_BLOGGERS_NO_POST_YET', $row->blogger->getName() ); ?></div>
									<?php } ?>
								</div>
							</div>

							<?php if(count($row->categories) > 0) : ?>
							<div class="tab-pane fade" id="tab-categories-<?php echo $row->id; ?>">
								<?php for($i = 0; $i < count($row->categories); $i++) : ?>
								<a class="butt butt-default butt-s" href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=blogger&layout=statistic&id='.$row->id. '&stat=category&catid='.$row->categories[$i]->id); ?>">
									<?php echo JText::_( $row->categories[$i]->title ); ?>
								</a>
								<?php endfor; ?>
							</div>
							<?php endif; ?>

							<div class="tab-pane fade" id="tab-tags-<?php echo $row->id; ?>">
								<?php
								$i  = 1;
								foreach( $row->tags as $tag )
								{
								?>
									<a class="butt butt-default butt-s" href="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog&view=blogger&layout=statistic&id='.$row->id.'&stat=tag&tagid=' . $tag->id );?>">
										<?php echo JText::_( $tag->title ); ?>
									</a>
								<?php
									$i++;
								}
								?>
							</div>
						</div>
					</div>
					<?php } // end show_bloggerstatsitem ?>
				</div>
			</div>

		<?php } ?>
	</div>

	<?php if( $pagination ){ ?>
		<div class="eblog-pagination clearfix"><?php echo $pagination; ?></div>
	<?php } ?>
</div>