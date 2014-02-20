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
<script type="text/javascript">
// to ensure that parent ID always revert back to 0 on page refresh
EasyBlog.ready(function($) {
	$('#frmComment #parent_id').val('0');
})
</script>

<form id="frmComment" class="style">
<div id="comment-form" class="blog-section clearfix">
	<a name="commentform" id="commentform"></a>

	<h3 class="section-title" id="comment-form-title"><?php echo JText::_('COM_EASYBLOG_LEAVE_YOUR_COMMENT');?></h3>
	<div id="eblog-message" class="eblog-message"></div>

	<div id="blogSubmitWait" style="display: none;"><img src="<?php echo rtrim(JURI::root(),'/') . '/components/com_easyblog/assets/images/loader.gif' ?>" alt="Loading" border="0" /></div>

	<div class="comment-form clearfix">

		<?php if( $system->config->get( 'layout_avatar') ){ ?>
		<div class="comment-avatar float-l">
			<?php if ( $system->my->id ) : ?>
				<img src="<?php echo $my->avatar; ?>" alt="<?php echo $my->displayName; ?>" class="avatar" />
			<?php else : ?>
				<img src="<?php echo rtrim(JURI::root(), '/') . '/components/com_easyblog/assets/images/default_blogger.png'; ?>" alt=""  class="avatar" />
			<?php endif; ?>
		</div>
		<?php } ?>

		<div class="comment-content">
			<div class="comment-head prel">
				<i class="comment-arrow pabs"></i>
				<span class="comment-name"><b><?php echo $my->displayName; ?></b></span>
				<span class="comment-date"><?php echo EasyBlogDateHelper::toFormat( EasyBlogDateHelper::dateWithOffSet() , $config->get('layout_dateformat', '%A, %d %B %Y')); ?></span>
			</div>

			<div class="comment-body prel">
				<i class="comment-arrow pabs"></i>

				<?php if($canRegister && $my->id == 0){ ?>
				<div class="form-row mtm">
					<label class="label"><?php echO JText::_('COM_EASYBLOG_FILL_IN_USERNAME_AND_FULLNAME_TO_REGISTER'); ?></label>
				</div>
				<?php } ?>

				<?php if( $config->get('comment_requiretitle', 0) || $config->get( 'comment_show_title' ) ){ ?>
				<div class="form-row comment-title mrm mtm">
					<input class="inputbox width-full ffa fsl fwb" type="text" id="title" name="title" onblur="if (this.value == '') {this.value = '<?php echo JText::_('COM_EASYBLOG_TITLE'); ?>';}" onfocus="if (this.value == '<?php echo JText::_('COM_EASYBLOG_TITLE'); ?>') {this.value = '';}" value="<?php echo JText::_('COM_EASYBLOG_TITLE'); ?>">
				</div>
				<?php } else { ?>
				<input type="hidden" id="title" name="title" value="" />
				<?php } ?>

				<div class="form-row comment-editor mtm">
					<textarea id="comment" name="comment" class="form-control width-full" rows="6"></textarea>
				</div>

				<?php if ( $my->id == 0 ) : ?>
					<?php if ( $canRegister ) : ?>
					<div class="form-row">
						<label class="label" for="esusername"><?php echo JText::_('COM_EASYBLOG_USERNAME'); ?> <small>(<?php echo JText::_('COM_EASYBLOG_REQUIRED_FOR_REGISTRATIONS'); ?>)</small></label>
					</div>
					<div class="form-row mtm">
						<input class="form-control width-full" type="text" id="esusername" name="esusername" placeholder="<?php echo JText::_('COM_EASYBLOG_USERNAME'); ?>">
					</div>
					<?php endif; ?>

					<div class="form-row mtm">
						<input class="form-control width-full" type="text" id="esname" name="esname" placeholder="<?php echo JText::_('COM_EASYBLOG_NAME' , true ); ?>">
					</div>

					<?php if( $config->get( 'comment_show_email' ) || $config->get('comment_require_email' ) || $canRegister ){ ?>
					<div class="form-row half float-l mtm">
						<input class="form-control width-full" type="text" id="esemail" name="esemail" placeholder="<?php echo JText::_('COM_EASYBLOG_EMAIL'); ?>">
					</div>
					<?php } ?>

				<?php endif; ?>


				<?php if( $config->get( 'comment_show_website' ) || $config->get('comment_required_website' ) ){ ?>
				<div class="form-row mtm<?php if ( $my->id == 0 ) { ?> half float-l<?php } ?>">
					<?php if ( $my->id == 0 ) { ?><div class="mlm"><?php } ?>
						<input class="form-control width-full" type="text" id="url" name="url" placeholder="<?php echo JText::_('COM_EASYBLOG_WEBSITE'); ?>">
					<?php if ( $my->id == 0 ) { ?></div><?php } ?>
				</div>
				<?php } ?>

				<div class="clear"></div>
				

				<?php echo EasyBlogHelper::getHelper( 'Captcha' )->getHTML();?>

				<?php if ( $my->id == 0 && $canRegister) : ?>
					<div class="form-row checkbox mtm mbm">
						<label>
							<input type="checkbox" id="esregister" name="esregister" value="y" />
							<?php echo JText::_('COM_EASYBLOG_REGISTER_AS_SITE_MEMBER'); ?>
						</label>
					</div>
				<?php endif; ?>

				<?php if($config->get('comment_tnc') && ( ( $config->get('comment_tnc_users') == 0 && $system->my->id <=0) || ( $config->get('comment_tnc_users') == 1 && $system->my->id >= 0) || ( $config->get('comment_tnc_users') == 2) ) ){ ?>
				<div class="form-row checkbox mtm mbm fsm">
					<label>
						<input type="checkbox" name="tnc" id="tnc" value="y" />
						<?php echo JText::sprintf('COM_EASYBLOG_AGREE_TERMS_AND_CONDITIONS', 'javascript: ejax.load(\'entry\', \'showTnc\');'); ?>
					</label>
				</div>
				<?php } ?>

				<div id="subscription-box" class="subscription-box fsm">
					<?php if ($subscriptionId) : ?>
						<div id="unsubscription-message" class="unsubscription-message mtm mbm"><?php echo JText::_('COM_EASYBLOG_ENTRY_AUTO_SUBSCRIBE_SUBSCRIBED_NOTE'); ?> <a href="javascript:void(0);" title="" onclick="eblog.blog.unsubscribe('<?php echo $subscriptionId; ?>', '<?php echo $blog->id; ?>');"><?php echo JText::_('COM_EASYBLOG_UNSUBSCRIBE_BLOG'); ?></a></div>
					<?php else : ?>
						<?php if($config->get('main_subscription') && $blog->subscription) : ?>
						<div id="subscription-message" class="subscription-message">
							<div class="clearfix mtm mbm">
								<input class="inputbox easyblog-checkbox" type="checkbox" name="subscribe-to-blog" id="subscribe-to-blog" value="yes" <?php echo $system->config->get( 'comment_autosubscribe' ) ? ' checked="checked"' :'';?> />
								<label for="subscribe-to-blog"><?php echo JText::_('COM_EASYBLOG_SUBSCRIBE_BLOG'); ?>
								<?php if( $my->id > 0 ) : ?>
								(<?php echo $my->email; ?>)
								<?php else: ?>
								(<?php echo JText::_('COM_EASYBLOG_ENTRY_AUTO_SUBSCRIBE_NOTE'); ?>)
								<?php endif; ?>
								</label>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<?php if ( $my->id != 0 ){ ?>
				<input type="hidden" id="esname" name="esname" value="<?php echo $this->escape( $my->name ); ?>" />
				<input type="hidden" id="esemail" name="esemail" value="<?php echo $this->escape( $my->email ); ?>" />
				<input type="hidden" id="url" name="url" value="<?php echo $this->escape( $my->url ); ?>" />
				<?php } ?>

				<input type="hidden" name="id" value="<?php echo $blog->id; ?>" />
				<input type="hidden" name="parent_id" id="parent_id" value="0" />
				<input type="hidden" name="comment_depth" id="comment_depth" value="0" />
				<input type="hidden" name="controller" value="blog" />
				<input type="hidden" name="task" value="commentSave" />
				<input type="hidden" id="totalComment" name="totalComment" value="<?php echo $counter; ?>" />

				<input class="butt butt-primary" type="button" id="btnSubmit" onclick="eblog.comment.save();return false;" value="<?php echo JText::_('COM_EASYBLOG_SUBMIT_COMMENT') ; ?>" />
			</div>

			<span class="bottom"><span class="inner"></span></span>
		</div>
	</div>
</div>
</form>