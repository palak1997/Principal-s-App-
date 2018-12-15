<section class="autocenter" data-offset-y="-20">
	<br/>
	<h1>
		<?php echo $this->Html->image('logo.png', array('alt' => 'Radical Logix', 'height' => '100px')); ?>
	</h1>
	<div id="reset-form" class="swap active">
		<h2 class="header-title" style="color:#26477e;">Step 2. Enter OTP</h2>
		<p class="instructions" style="text-align:justify; color:#000000;">Kindly enter OTP sent. ( Do Not Close or Refresh the browser )</p>
		<?php echo $this->Form->create("User",array('action' => 'confirmotp')); ?>

						<?php echo $this->Form->input('username', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => $userinfo['username'])); ?>

						<div class="form-field">
                            <?php echo $this->Form->input('otp',array('label' => false,'class' => 'wide mail-check','style' => 'width:300px; ', 'placeholder' => 'OTP')); ?>
                        </div>

	                    <br/>
						<p class="header-title nav-inner">
                            <?php echo $this->Js->submit('Resend OTP ?',array('url'=>array('action'=>'resendotp','controller'=>'Users'),'update'=>'#alertmessage','class'=>'swap-init','value'=>'Go','label'=>false,'div'=>false,'type'=>'button','style'=>'margin:0px; background:none; font-weight:bold; color:#0000FF;')); ?>
						</p>
						<span id="alertmessage">
        
    					</span>
                        <?php echo $this->Form->input("Submit OTP",array("label" => false, "div"=>false, "value" => "Proceed", "type" => "submit", "class" => "button-pri mid")); ?>
                       
                <?php echo $this->Form->end(); ?>
		
	</div>
    
</section>

<footer>
	<div class="footer_copyright">Powered By © <a href="http://www.radicallogix.com" target="_blank">Radical Logix</a>. All Rights Reserved.</div>
	<div class="footer_sitelinks">
		<ul>
	    	<li style="font-weight:bold; color:#26477e;"><u>Note</u> : Use Latest Version of Browsers, Preferably (Google Chrome or Mozilla Firefox)</li>
	    </ul>
	</div>
</footer>