<?php /* Smarty version Smarty-3.1.18, created on 2017-02-15 18:00:30
         compiled from "/Users/bart/Websites/themarket/library/templates/cms_form_created.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5941316258a47b1e968446-68098964%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1d129063bbe6ddcc3d61295da7fe99e5843ad40' => 
    array (
      0 => '/Users/bart/Websites/themarket/library/templates/cms_form_created.tpl',
      1 => 1487174153,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5941316258a47b1e968446-68098964',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'translate' => 0,
    'settings' => 0,
    'table' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58a47b1e997805_69759804',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a47b1e997805_69759804')) {function content_58a47b1e997805_69759804($_smarty_tpl) {?><div class="created light small">
<?php if ($_smarty_tpl->tpl_vars['data']->value['created']) {?>
	<?php echo $_smarty_tpl->tpl_vars['translate']->value['cms_form_createdby'];?>
 <?php if ($_smarty_tpl->tpl_vars['data']->value['created_by']) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['created_by'];?>
<?php } else { ?><em><?php echo $_smarty_tpl->tpl_vars['translate']->value['cms_form_createdunknown'];?>
</em><?php }?><br /><?php echo $_smarty_tpl->tpl_vars['translate']->value['cms_form_ondate'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['created'];?>
 <br /><br />
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['data']->value['modified']) {?>
	<?php echo $_smarty_tpl->tpl_vars['translate']->value['cms_form_modifiedby'];?>
 <?php if ($_smarty_tpl->tpl_vars['data']->value['modified_by']) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['modified_by'];?>
<?php } else { ?><em><?php echo $_smarty_tpl->tpl_vars['translate']->value['cms_form_createdunknown'];?>
</em><?php }?><br /><?php echo $_smarty_tpl->tpl_vars['translate']->value['cms_form_ondate'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['modified'];?>
 
	<?php if ($_smarty_tpl->tpl_vars['settings']->value['showhistory']) {?><br /> <br /><i class="fa fa-history"></i> <a href="<?php echo $_smarty_tpl->tpl_vars['settings']->value['rootdir'];?>
/ajax.php?file=history&table=<?php if ($_smarty_tpl->tpl_vars['table']->value) {?><?php echo $_smarty_tpl->tpl_vars['table']->value;?>
<?php } else { ?><?php echo $_GET['action'];?>
<?php }?>&id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" class="fancybox" data-fancybox-type="ajax"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cms_form_view_modified'];?>
</a><?php }?>
<?php }?>
</div><?php }} ?>