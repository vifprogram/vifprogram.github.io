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

$acl			= EasyBlogACLHelper::getRuleSet();
$isBloggerMode	= EasyBlogRouter::isBloggerMode();
$itemid			= JRequest::getVar('Itemid', '');
$menu			= JFactory::getApplication()->getMenu();
$item			= $menu->getItem($itemid);
$params  		= EasyBlogHelper::getRegistry();

if( $item )
{
	$params->load( $item->params );
}
?>
<?php if( $system->config->get( 'layout_responsive' ) ){ ?>
<script type="text/javascript">
EasyBlog
.require()
.script('layout/responsive')
.done(function($){

	$('#ezblog-head #ezblog-search').bind('focus', function(){
		$(this).animate({ width: '170'} );
	});

	$('#ezblog-head #ezblog-search').bind( 'blur' , function(){
		$(this).animate({ width: '120'});
	});

	$('#ezblog-menu').responsive({at: 540, switchTo: 'narrow'});
	$('.eb-nav-collapse').responsive({at: 560, switchTo: 'nav-hide'});
	$('.btn-eb-navbar').click(function() {
		$('.eb-nav-collapse').toggleClass("nav-show");
		return false;
	});
});


EasyBlog.ready(function($){


	$(document)
		.on("click.eb.navdrop", ".dropper > a", function(){

			var parent = $(this).parent(".dropper"),
				open = parent.hasClass("open");

			$(".dropper").removeClass("open");
			parent.toggleClass("open", !open);
		});

});








</script>
<?php } ?>
<?php echo EasyBlogHelper::renderModule( 'easyblog-before-header' ); ?>
<?php if ( $system->config->get( 'main_rss' ) || $system->config->get( 'main_sitesubscription' ) || $system->config->get( 'layout_headers' ) || $system->config->get( 'layout_toolbar' ) ) { ?>
<div id="ezblog-head">
	<div class="in clearfix">
<?php } ?>

		<?php if( $system->config->get( 'main_sitesubscription' )  ||  $system->config->get( 'main_rss' ) ){ ?>
		<div class="component-links float-r">
			<?php if( $system->config->get( 'main_sitesubscription' ) ){ ?>
			<a href="javascript:void(0);" onclick="eblog.subscription.show('<?php echo EBLOG_SUBSCRIPTION_SITE; ?>');" class="link-email">
				<span><?php echo JText::_('COM_EASYBLOG_SUBSCRIPTION_SUBSCRIBE_TO_SITE'); ?></span>
			</a>
			<?php } ?>

			<?php if( $system->config->get( 'main_rss' ) ){ ?>
			<a href="<?php echo EasyBlogHelper::getHelper( 'Feeds' )->getFeedURL( 'index.php?option=com_easyblog&view=latest' );?>" title="<?php echo JText::_('COM_EASYBLOG_SUBSCRIBE_FEEDS'); ?>" class="link-rss">
				<span><?php echo JText::_('COM_EASYBLOG_SUBSCRIBE_FEEDS'); ?></span>
			</a>
			<?php } ?>
		</div>
		<?php } ?>
		
		<?php 
			$show_page_heading  = $params->get( 'show_page_heading' , '' );
			if( $system->config->get('layout_headers') ){ 
			if ($show_page_heading) { $title = $params->get( 'page_heading' , '' ); }
		?>

		<h1 class="component-title reset-h"><?php echo JText::_( $title ); ?></h1>
		<p class="rip mts mbm"><?php echo JText::_( $desc ); ?></p>
		<?php } ?>



		<?php echo EasyBlogHelper::renderModule( 'easyblog-before-toolbar' ); ?>
		<?php if( $system->config->get('layout_toolbar') && $this->acl->rules->access_toolbar ){ ?>
		<div id="ezblog-nav">
			<form method="get" class="nav-search hide" action="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog&view=search&layout=parsequery' );?>" data-eb-toolbar-search-form>
				<div>
					<input type="text" class="form-control" placeholder="<?php echo JText::_( 'COM_EASYBLOG_SEARCH_TEXT_PLACEHOLDER' );?>" name="query" value="<?php echo $this->escape( JRequest::getVar( 'query' ) );?>" />
					<i class="i-search"></i>
					<a href="javascript:void(0);" data-eb-toolbar-search-toggle><i class="i-remove"></i></a>

					<?php if( EasyBlogHelper::getJConfig()->get( 'sef' ) != 1 ){ ?>
					<input type="hidden" name="option" value="com_easyblog" />
					<input type="hidden" name="view" value="search" />
					<input type="hidden" name="layout" value="parsequery" />
					<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
					<?php } ?>
				</div>
			</form>
			<ul class="reset-ul float-li clearfix">
				<li class="dropdown_">
					<a class="ico-text" data-foundry-toggle="dropdown" href="javascript:void(0);">
						<i class="i-reorder"></i>
						Navigation
					</a>
					<ul class="nav-drop reset-ul">
						<?php if($system->config->get('layout_latest', 1)) : ?>
						<li class="<?php echo $views->home;?>">
							<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=latest'); ?>">
								<?php echo JText::_('COM_EASYBLOG_TOOLBAR_LATEST_POSTS'); ?>
							</a>
						</li>
						<?php endif; ?>

						<?php if($system->config->get('layout_categories', 1)) : ?>
						<li class="<?php echo $views->categories;?>">
							<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=categories'); ?>">
								<?php echo JText::_('COM_EASYBLOG_TOOLBAR_CATEGORIES'); ?>
							</a>
						</li>
						<?php endif; ?>

						<?php if($system->config->get('layout_tags', 1)) : ?>
						<li class="<?php echo $views->tags;?>">
							<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=tags'); ?>">
								<?php echo JText::_('COM_EASYBLOG_TOOLBAR_TAGS'); ?>
							</a>
						</li>
						<?php endif; ?>

						<?php if($isBloggerMode === false) : ?>
							<?php if($system->config->get('layout_bloggers', 1)) : ?>
							<li class="<?php echo $views->blogger;?>">
								<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=blogger'); ?>">
									<?php echo JText::_('COM_EASYBLOG_TOOLBAR_BLOGGERS'); ?>
								</a>
							</li>
							<?php endif; ?>

							<?php if($system->config->get('layout_teamblog', 1)) : ?>
							<li class="<?php echo $views->teamblog;?>">
								<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=teamblog'); ?>">
									<?php echo JText::_('COM_EASYBLOG_TOOLBAR_TEAMBLOGS'); ?>
								</a>
							</li>
							<?php endif; ?>
						<?php endif; ?>

						<?php if($system->config->get('layout_archive', 1)) : ?>
						<li class="<?php echo $views->archive;?>">
							<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=archive'); ?>">
								<?php echo JText::_('COM_EASYBLOG_TOOLBAR_ARCHIVE'); ?>
							</a>
						</li>
						<?php endif; ?>
					</ul>
				</li>



				<?php if( $system->my->id < 1 ){ ?>
				<?php if( $system->config->get( 'layout_login' ) ){ ?>
				<li class="dropdown_ float-r">
					<a data-foundry-toggle="dropdown" href="javascript:void(0);"><i class="i-lock"></i></a>
					<div class="nav-drop nav-login">
						<form action="<?php echo JRoute::_( 'index.php' );?>" method="post">
							<div class="form-group">
								<label for="username" class="float-l width-full rip">
									<span class="trait"><?php echo JText::_('COM_EASYBLOG_USERNAME') ?></span>
									<a href="<?php echo EasyBlogHelper::getRegistrationLink();?>" class="float-r"><?php echo JText::_( 'COM_EASYBLOG_REGISTER' );?></a>
								</label>
								<input id="username" type="text" name="username" class="form-control width-full" alt="username" tabindex="31"/>
							</div>

							<div class="form-group">
								<label for="passwd" class="float-l width-full rip">
									<span class="trait"><?php echo JText::_('COM_EASYBLOG_PASSWORD') ?></span>
									<a href="<?php echo EasyBlogHelper::getResetPasswordLink();?>" class="float-r"><?php echo JText::_( 'COM_EASYBLOG_FORGOTTEN_PASSWORD' );?></a>
								</label>
								<?php if( EasyBlogHelper::getJoomlaVersion() >= '1.6' ){ ?>
								<input type="password" id="passwd" class="form-control width-full" name="password" tabindex="32"/>
								<?php } else { ?>
								<input type="password" id="passwd" class="form-control width-full" name="passwd" tabindex="32"/>
								<?php } ?>
							</div>
							<div class="form-group">
								<?php if(JPluginHelper::isEnabled('system', 'remember')) { ?>
								<div class="checkbox float-l">
									<label>
										<input id="remember" type="checkbox" name="remember" value="yes" alt="Remember Me" tabindex="33"/>
										<?php echo JText::_('COM_EASYBLOG_REMEMBER_ME') ?>
									</label>
								</div>
								<?php } ?>
								<button class="butt butt-primary float-r" type="submit" tabindex="34"><?php echo JText::_('COM_EASYBLOG_LOGIN') ?></button>
							</div>

							<?php if( EasyBlogHelper::getJoomlaVersion() >= '1.6' ){ ?>
							<input type="hidden" value="com_users"  name="option">
							<input type="hidden" value="user.login" name="task">
							<input type="hidden" name="return" value="<?php echo $return; ?>" />
							<?php } else { ?>
							<input type="hidden" value="com_user"  name="option">
							<input type="hidden" value="login" name="task">
							<input type="hidden" name="return" value="<?php echo $return; ?>" />
							<?php } ?>
							<?php echo JHTML::_( 'form.token' ); ?>
						</form>
					</div>
				</li>
				<?php } //$system->my->id ?>

				<?php } else { ?>

				<?php if( $system->config->get( 'layout_option_toolbar' ) ) { ?>
				<li class="dropdown_ float-r">
					<a data-foundry-toggle="dropdown" href="javascript:void(0);">
						<i class="i-cog"></i>
					</a>
					<ul class="reset-ul nav-drop">
						<li>
							<div class="nav-user">
								<?php if( $system->config->get( 'toolbar_editprofile' ) ){ ?>
								<a href="<?php echo EasyBlogHelper::getEditProfileLink();?>" class="avatar nav-avatar float-l">
									<img class="avatar" src="<?php echo $system->profile->getAvatar();?>" />
								</a>
								<?php } else { ?>
								<a href="javascript:void(0);" class="avatar nav-avatar float-l">
									<img class="avatar" src="<?php echo $system->profile->getAvatar();?>" />
								</a>
								<?php } ?>
								<div>
									<a href="<?php echo $system->profile->getProfileLink(); ?>" class="user-name"><?php echo $system->profile->getName();?></a>
									<?php if( $system->config->get( 'toolbar_editprofile' ) ){ ?>
									<br />
									<a href="<?php echo EasyBlogHelper::getEditProfileLink();?>" class="muted"><?php echo JText::_( 'COM_EASYBLOG_TOOLBAR_DASHBOARD_EDIT_PROFILE' );?></a>
									<?php } ?>
								</div>
							</div>
						</li>

						<?php if(($acl->rules->publish_entry) || ($acl->rules->add_entry) || ($acl->rules->delete_entry)) { ?>
						<li>
							<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=dashboard&layout=entries'); ?>">
								<?php echo JText::_('COM_EASYBLOG_TOOLBAR_DASHBOARD_ENTRIES');?>
							</a>
						</li>
						<?php } ?>

						<?php if(($acl->rules->add_entry)) { ?>
						<li>
							<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=dashboard&layout=review'); ?>">
								<?php echo JText::_('COM_EASYBLOG_DASHBOARD_TOOLBAR_REVIEW');?>
							</a>
						</li>
						<?php } ?>

						<?php if($acl->rules->manage_comment && EasyBlogHelper::getHelper( 'Comment')->isBuiltin() ) : ?>
						<li>
							<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=dashboard&layout=comments'); ?>">
								<?php echo JText::_('COM_EASYBLOG_TOOLBAR_DASHBOARD_COMMENTS'); if($totalModComment > 0) { echo '<sup>' . $totalModComment. '</sup>'; } ?>
							</a>
						</li>
						<?php endif; ?>

						<?php if($acl->rules->create_category) : ?>
						<li>
							<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=dashboard&layout=categories'); ?>">
								<?php echo JText::_('COM_EASYBLOG_TOOLBAR_DASHBOARD_CATEGORIES');?>
							</a>
						</li>
						<?php endif; ?>

						<?php if($acl->rules->create_tag) : ?>
						<li>
							<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=dashboard&layout=tags'); ?>">
								<?php echo JText::_('COM_EASYBLOG_TOOLBAR_DASHBOARD_TAGS');?>
							</a>
						</li>
						<?php endif; ?>

						<li>
							<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=subscription'); ?>">
								<?php echo JText::_('COM_EASYBLOG_TOOLBAR_DASHBOARD_SUBSCRIPTION');?>
							</a>
						</li>

						<?php if($isTeamAdmin) : ?>
						<li>
							<a class="blog" href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=dashboard&layout=teamblogs'); ?>">
								<?php echo JText::_('COM_EASYBLOG_TOOLBAR_DASHBOARD_TEAMBLOG_REQUESTS'); ?>
								<?php echo ($totalTeamRequest > 0) ? '<b>' . $totalTeamRequest . '</b>' : '' ?>
							</a>
						</li>
						<?php endif; ?>

						<?php if( $system->config->get( 'toolbar_logout') ){ ?>
						<li>
							<form id="eblog-logout" action="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog' );?>">
								<a class="logout" href="javascript:eblog.dashboard.logout();">
									<?php echo JText::_( 'COM_EASYBLOG_TOOLBAR_DASHBOARD_LOGOUT' );?>
								</a>
								<?php if( EasyBlogHelper::getJoomlaVersion() >= '1.6' ){ ?>
								<input type="hidden" value="com_users"  name="option">
								<input type="hidden" value="user.logout" name="task">
								<input type="hidden" value="<?php echo $logoutURL; ?>" name="return">
								<?php } else { ?>
								<input type="hidden" value="com_user"  name="option">
								<input type="hidden" value="logout" name="task">
								<input type="hidden" value="<?php echo $logoutURL; ?>" name="return">
								<?php } ?>
								<?php echo JHTML::_( 'form.token' ); ?>
							</form>
						</li>
						<?php } ?>
					</ul>
				</li>
				<?php } ?>
				<?php } ?>

				<li class="float-r">
					<a href="javascript:void(0);" data-eb-toolbar-search-toggle>
						<i class="i-search"></i>
					</a>
				</li>
				
			</ul>
		</div>
		<?php } ?>
		<?php echo EasyBlogHelper::renderModule( 'easyblog-after-toolbar' ); ?>

<?php if ( $system->config->get( 'main_rss' ) || $system->config->get( 'main_sitesubscription' ) || $system->config->get( 'layout_headers' ) || $system->config->get( 'layout_toolbar' ) ) { ?>
	</div>
</div>
<?php } ?>


<script type="text/javascript">
EasyBlog.ready(function($){

$(document).on("click", "[data-eb-toolbar-search-toggle]", function(){
	$("[data-eb-toolbar-search-form]").toggleClass("hide");
});

});
</script>