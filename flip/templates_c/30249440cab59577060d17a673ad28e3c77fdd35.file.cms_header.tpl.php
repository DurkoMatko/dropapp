<?php /* Smarty version Smarty-3.1.18, created on 2017-02-15 15:48:07
         compiled from "/Users/maartenhunink/Sites/themarket/library/templates/cms_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:78489548858a45c17618083-13354950%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30249440cab59577060d17a673ad28e3c77fdd35' => 
    array (
      0 => '/Users/maartenhunink/Sites/themarket/library/templates/cms_header.tpl',
      1 => 1487166423,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78489548858a45c17618083-13354950',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lan' => 0,
    'title' => 0,
    'translate' => 0,
    'settings' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58a45c17642c63_50212638',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a45c17642c63_50212638')) {function content_58a45c17642c63_50212638($_smarty_tpl) {?><!DOCTYPE html>
<html <?php if ($_smarty_tpl->tpl_vars['lan']->value=='ar') {?>dir="rtl"<?php }?> lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if ($_smarty_tpl->tpl_vars['title']->value) {?><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 - <?php }?><?php echo $_smarty_tpl->tpl_vars['translate']->value['site_name'];?>
</title>

    <!-- Bootstrap -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['settings']->value['rootdir'];?>
/assets/css/css.php" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['settings']->value['rootdir'];?>
/assets/css/custom.css" rel="stylesheet">    
    <link href="<?php echo $_smarty_tpl->tpl_vars['settings']->value['rootdir'];?>
/assets/css/print.css" rel="stylesheet" media="print">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $_smarty_tpl->tpl_vars['settings']->value['rootdir'];?>
/assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['settings']->value['rootdir'];?>
/assets/img/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['settings']->value['rootdir'];?>
/assets/img/favicon-16x16.png" sizes="16x16">
    
  </head>

  <body class="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
<?php }} ?>