<?php /* Smarty version Smarty-3.1.18, created on 2015-08-28 03:40:55
         compiled from "./templates/form-expertprogramma.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1285475665556ddb5b9f9b43-66431319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75bf9d8e22e9f780dd966be73d62bea7ac9543e0' => 
    array (
      0 => './templates/form-expertprogramma.tpl',
      1 => 1440680124,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1285475665556ddb5b9f9b43-66431319',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_556ddb5ba7d429_49571851',
  'variables' => 
  array (
    'page' => 0,
    'expert' => 0,
    'formdata' => 0,
    'translate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556ddb5ba7d429_49571851')) {function content_556ddb5ba7d429_49571851($_smarty_tpl) {?> <form action="index.php" method="post" data-lan="nl" id="orderform">

    <div class="form-section">
	    <div class="row">
		    <div class="col col-sm-8 col-md-9 col-lg-8">
			    <div class="row">
			        <div class="col col-sm-12 form-row">
				        <h3>Mijn vraag aan Cultuur+Ondernemen</h3>
			        </div>
			    </div>
		    </div>
	    </div>
	    <div class="row">
		    <div class="col col-sm-8 col-md-9 col-lg-8">
			    <div class="row">
			        <div class="col col-sm-12 form-row">
			        	<label for="question">Omschrijf je vraagstuk <span class="form-required-highlight">*</span></label>
			        	<textarea id="question" type="text" name="question" class="form-adjust required"></textarea>
			        </div>
			    </div>
		    </div>
		    <div class="col col-sm-4 col-md-3 col-lg-2">
			    <div class="form-side-info question">Waar gaat je vraag over? Naar aanleiding van je vraag kiezen wij de juiste gesprekspartner voor je</div>
		    </div>
	    </div>
	    <div class="row">
	        <div class="col col-sm-8 col-md-9 col-lg-8">
		        <label for="orgtype">kies de gewenste expert</label>
		        <div class="form-select">
					<select class="select" id="expert" name="expert">
						<option>Kies</option>
						<?php  $_smarty_tpl->tpl_vars['expert'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['expert']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['experts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['expert']->key => $_smarty_tpl->tpl_vars['expert']->value) {
$_smarty_tpl->tpl_vars['expert']->_loop = true;
?>
			        	<option value="<?php echo $_smarty_tpl->tpl_vars['expert']->value['fullname'];?>
"><?php echo $_smarty_tpl->tpl_vars['expert']->value['fullname'];?>
</option>
			        	<?php } ?>
					</select>
				</div>
	        </div>
	    </div>
    </div>
    <div class="form-section">
	    <div class="row">
		    <div class="col col-sm-8 col-md-9 col-lg-8">
			    <div class="row">
			        <div class="col col-sm-12 form-row">
			        	<h3>Mijn gegevens</h3>
						<div class="form-required-highlight">* invullen verplicht</div>
					</div>
			    </div>
			    <div class="row">
			        <div class="col col-sm-8 col-md-5 form-row">
			        	<label for="firstname">voornaam <span class="form-required-highlight">*</span></label>
			        	<input id="firstname" type="text" name="firstname" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['firstname'];?>
" class="form-adjust required">
			        </div>
			        <div class="col col-sm-4 col-md-2 form-row">
			        	<label for="inbetween">tussenvoegsel</label>
			        	<input id="inbetween" type="text" name="inbetween" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['inbetween'];?>
" class="form-adjust">
			        </div>
			        <div class="col col-sm-12 col-md-5 form-row">
						<label for="lastname">achternaam <span class="form-required-highlight">*</span></label>
						<input id="lastname" type="text" name="lastname" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['lastname'];?>
" class="form-adjust required">
			        </div>
			    </div>
			    <div class="row">
			        <div class="col col-sm-6 form-row">
			        	<label for="email">e-mailadres <span class="form-required-highlight">*</span></label>
			        	<input id="email" type="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['email'];?>
" class="form-adjust required">
			        </div>
			        <div class="col col-sm-6 form-row">
						<label for="phone">telefoon <span class="form-required-highlight">*</span></label>
						<input id="phone" type="text" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['phone'];?>
" class="form-adjust required">
			        </div>
			    </div>
			    <div class="row">
			        <div class="col col-sm-12 form-row">
			        	<label for="website">website</label>
			        	<input id="website" type="text" name="website" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['website'];?>
" class="form-adjust">
			        </div>
			    </div>
		    </div>
	    </div>
    </div>
    <div class="form-section">
    	<div class="row">
	    	<div class="col col-sm-8 col-md-9 col-lg-8">
			    <div class="row">
			        <div class="col col-sm-12 form-row">

				        <label for="type">achtergrond <span class="form-required-highlight">*</span></label>
				        <div class="form-select">
							<select class="select required" id="type" name="type" onchange="
				        		document.getElementById('voorzelfstandig').style.display = (this.selectedIndex==1?'block':'none');
				        		document.getElementById('voorbedrijf').style.display = (this.selectedIndex==2?'block':'none');">
								<option value="">kies</option>
								<option value="zelfstandig">Ik ben zelfstandige</option>
								<option value="bedrijf">Ik vertegenwoordig een bedrijf / instelling</option>
							</select>
						</div>
			        </div>
			    </div>
			    <!-- Dit deel is voor zelfstandig -->
			    <div id="voorzelfstandig" style="display:none">
				    <div class="row">
				        <div class="col col-sm-12 form-row">
				        	<label for="city">woonplaats <span class="form-required-highlight">*</span></label>
				        	<input id="city" type="text" name="city" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['city'];?>
" class="form-adjust required">
				        </div>
				    </div>
				    <div class="row">
				        <div class="col col-sm-12 form-row">
				        	<label for="function">beroep</label>
				        	<input id="function" type="text" name="function" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['function'];?>
" class="form-adjust">
				        </div>
				    </div>
			    </div>
				<!-- Tot hier voor zelfstandig -->

			    <!-- Dit deel is voor bedrijf -->
			    <div id="voorbedrijf" style="display:none">
				    <div class="row">
				        <div class="col col-sm-12 form-row">
				        	<label for="company">bedrijf/organisatie <span class="form-required-highlight">*</span></label>
				        	<input id="company" type="text" name="company" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['company'];?>
" class="form-adjust required">
				        </div>
				    </div>
				    <div class="row">
				        <div class="col col-sm-12 form-row">
				        	<label for="function">functie</label>
				        	<input id="function" type="text" name="function" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['function'];?>
" class="form-adjust">
				        </div>
				    </div>
				    <div class="row">
				        <div class="col col-sm-12 form-row">
				        	<label for="city2">plaats <span class="form-required-highlight">*</span></label>
				        	<input id="city2" type="text" name="city2" value="<?php echo $_smarty_tpl->tpl_vars['formdata']->value['city'];?>
" class="form-adjust required">
				        </div>
				    </div>
				    <div class="row">
				        <div class="col col-sm-12 form-row">

					        <label for="orgtype">soort organisatie</label>
					        <div class="form-select">
								<select class="select" id="orgtype" name="orgtype">
									<option>Kies</option>
						        	<option value="Culturele instelling">Culturele instelling</option>
						        	<option value="Overheid">Overheid</option>
						        	<option value="Fonds">Fonds</option>
						        	<option value="Brancheorganisatie">Brancheorganisatie</option>
						        	<option value="Publieke sector">Publieke sector</option>
						        	<option value="Fonds">Fonds</option>
						        	<option value="Zorg en welzijn">Zorg en welzijn</option>
						        	<option value="Onderwijs en educatie">Onderwijs en educatie</option>
						        	<option value="Bedrijfsleven">Bedrijfsleven</option>
								</select>
							</div>
				        </div>
				    </div>
			    </div>
				<!-- Tot hier voor bedrijf -->
		    </div>
	    </div>
    </div>
	<div class="form-section">
	    <div class="row">
		    <div class="col col-sm-8 col-md-9 col-lg-8">
			     <div class="form-row">
				     <div class="form-checkbox clearfix">
						<input type="checkbox" value="1" id="savedata" name="savedata" <?php if ($_smarty_tpl->tpl_vars['formdata']->value) {?>checked<?php }?> />
						<label for="savedata" class="label-lg">Bewaar mijn gegevens voor een volgende keer<span class="label-extra-info"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save_data_form'];?>
</span></label>
					</div>
					<div class="form-checkbox clearfix">
						<input type="checkbox" value="1" id="newsletter" name="newsletter" />
						<label for="newsletter" class="label-lg">Ik meld me aan voor de nieuwsbrief van Cultuur+Ondernemen</label>
					</div>
			    </div>
		    </div>
	    </div>
	</div>
   	<div class="form-section">
	    <div class="row">
		    <div class="col col-sm-12">
				<div class="payment-button"><button class="btn btn-blue"><span class="btn-text">Aanvraag verzenden</span><span class="icon icon-arrow-right"></span></button></div>
		    </div>
	    </div>
    </div>

    <input type="hidden" name="products_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
" />
    <input type="hidden" name="action" value="mailen" />
    <input type="text" name="special" class="special" value="" />

 </form>







<?php }} ?>
