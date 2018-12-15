<section class="autocenter" data-offset-y="-20">
	<br/>
	<h1>
		<?php echo $this->Html->image('logo.png', array('alt' => 'Radical Logix', 'height' => '100px')); ?>
	</h1>
	<div id="reset-form" class="swap active">
		<h2 class="header-title" style="color:#26477e;">Step 1. Generate OTP</h2>
		<p class="instructions" style="text-align:justify; color:#000000;">Please select where you want to receive OTP. ( Do Not Close or Refresh the browser )</p>
		<?php echo $this->Form->create("User",array('action' => 'sendotp')); ?>

						<?php echo $this->Form->input('username', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => $userinfo['username'])); ?>

						<?php if (!empty($userinfo['contact_no']) && $smstemplate && $smstemplate['Smstemplate']['is_active'] == 'Yes')  { ?>
	                    <div class="form-field">
                            <label style="width:200px; color:#000000;font-weight:bold; ">Mobile</label>
                            <?php echo $this->Form->input('smsflag',array('type' => 'checkbox','label' => false,'div'=>false,'class' => 'wide mail-check','style'=>'width:15px; margin-left:30px;')); ?>
                            <label style="width:200px; color:#000000; font-weight:bold;"><?php echo $userinfo['contact_no']; ?></label>
                        </div>
	                    <?php } else { ?>
	                    <div class="form-field">
                            <label style="width:200px; color:#000000;font-weight:bold; ">Mobile</label>
                            <label style="width:200px; color:#000000; font-weight:bold; margin-left:32px;"> : Not Found in Record</label>
                        </div>
	                    <?php } ?>
	                    
	                    <?php if (!empty($userinfo['email']))  { ?>
	                    <div class="form-field">
                            <label style="width:200px; color:#000000;font-weight:bold; ">Email</label>
                            <?php echo $this->Form->input('emailflag',array('type' => 'checkbox','label' => false,'class' => 'wide mail-check','style'=>'width:15px; margin-left:37px;','div'=>false)); ?>
                            <label style="width:200px; color:#000000; font-weight:bold;"><?php echo $userinfo['email']; ?></label>
	                    </div>
                	    
	                    <?php } else { ?>

	                    <div class="form-field">
                            <label style="width:200px; color:#000000;font-weight:bold; ">Email</label>
                            <label style="width:200px; color:#000000; font-weight:bold; margin-left:32px;"> : Not Found in Record</label>
                        </div>

	                    <?php } ?>
	                    <br/>
						<?php echo $this->Form->input("Generate OTP",array("label" => false, "div"=>false, "value" => "Proceed", "type" => "submit", "class" => "button-pri mid")); ?>
                       
                <?php echo $this->Form->end(); ?>
		
	</div>
        
        <?php //echo $this->Session->flash(); ?>
</section>

<footer>
	<div class="footer_copyright">Powered By © <a href="http://www.radicallogix.com" target="_blank">Radical Logix</a>. All Rights Reserved.</div>
	<div class="footer_sitelinks">
		<ul>
	    	<li style="font-weight:bold; color:#26477e;"><u>Note</u> : Use Latest Version of Browsers, Preferably (Google Chrome or Mozilla Firefox)</li>
	    </ul>
	</div>
</footer>