<?php /* Smarty version Smarty-3.1.18, created on 2017-02-15 15:48:07
         compiled from "/Users/maartenhunink/Sites/themarket/library/templates/cms_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:62644280358a45c1753c784-61454252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dedceddf032f5256a293300cbf748c82980947ed' => 
    array (
      0 => '/Users/maartenhunink/Sites/themarket/library/templates/cms_index.tpl',
      1 => 1487166423,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62644280358a45c1753c784-61454252',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu' => 0,
    'item' => 0,
    'subitem' => 0,
    'modal' => 0,
    'include' => 0,
    'include2' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58a45c176102e6_78582474',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a45c176102e6_78582474')) {function content_58a45c176102e6_78582474($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("cms_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<nav class="pushy pushy-open visible-xs">
    <a href="#" class="pushy-close fa fa-times"></a>
    <ul class="level0">
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
      <li class="nav-header"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</li>
      <li>
          <ul class="level1">
    <?php  $_smarty_tpl->tpl_vars['subitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subitem']->key => $_smarty_tpl->tpl_vars['subitem']->value) {
$_smarty_tpl->tpl_vars['subitem']->_loop = true;
?>
            <li<?php if ($_smarty_tpl->tpl_vars['subitem']->value['active']) {?> class="active"<?php }?>><a href="?action=<?php echo $_smarty_tpl->tpl_vars['subitem']->value['include'];?>
"><?php echo $_smarty_tpl->tpl_vars['subitem']->value['title'];?>
<?php if ($_smarty_tpl->tpl_vars['subitem']->value['alert']) {?><i class="fa fa-exclamation-circle"></i><?php }?></a></li>
      <?php } ?>
          </ul>
      </li>
     <?php } ?>
    </ul>
</nav>

<!-- Site Overlay -->
<div class="site-overlay"></div>

<!-- Your Content -->
<div id="container" <?php if ($_smarty_tpl->tpl_vars['modal']->value) {?>class="modal-form"<?php }?>>
<?php if (!$_smarty_tpl->tpl_vars['modal']->value) {?><?php echo $_smarty_tpl->getSubTemplate ("cms_topmenu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }?>

  <div class="container-fluid">
  	<?php if (!$_smarty_tpl->tpl_vars['modal']->value) {?>
	    <div class="nav-aside hidden-xs">
	      <ul class="level0">
	      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
	        <li class="nav-header"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</li>
	        <li>
	            <ul class="level1">
				<?php  $_smarty_tpl->tpl_vars['subitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subitem']->key => $_smarty_tpl->tpl_vars['subitem']->value) {
$_smarty_tpl->tpl_vars['subitem']->_loop = true;
?>
	              <li<?php if ($_smarty_tpl->tpl_vars['subitem']->value['active']) {?> class="active"<?php }?>><a href="?action=<?php echo $_smarty_tpl->tpl_vars['subitem']->value['include'];?>
"><?php echo $_smarty_tpl->tpl_vars['subitem']->value['title'];?>
<?php if ($_smarty_tpl->tpl_vars['subitem']->value['alert']) {?><i class="fa fa-exclamation-circle"></i><?php }?></a></li>
				  <?php } ?>
	            </ul>
	        </li>
	       <?php } ?>
	      </ul>
	    </div>
	<?php }?>
    <div class="content">
	    <?php if ($_smarty_tpl->tpl_vars['include']->value) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }?>
	    <?php if ($_smarty_tpl->tpl_vars['include2']->value) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['include2']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }?>
    </div>
  </div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("cms_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>