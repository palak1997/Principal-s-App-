<section class="autocenter" data-offset-y="-20">
	<br/>
	<h1>
		<?php echo $this->Html->image('logo.png', array('alt' => 'Radical Logix', 'height' => '100px')); ?>
	</h1>
	<div id="reset-form" class="swap active">
		<h2 class="header-title" style="color:#26477e;">Forgot your password?</h2>
		<p class="instructions" style="text-align:justify; color:#000000;">Enter Username & Registered Mobile Number ( On Which you receive regular SMS from School )</p>
		<?php echo $this->Form->create("User",array('action' => 'generateotp')); ?>
						<div class="form-field">
                            <?php echo $this->Form->input('username',array('label' => false,'class' => 'wide mail-check','style' => 'width:300px; ', 'placeholder' => 'Username')); ?>
                        </div>
                	    <div class="form-field">
                            <?php echo $this->Form->input('emailid',array('label' => false,'class' => 'wide mail-check','style' => 'width:300px; ', 'placeholder' => 'Mobile Number (Without 0 or +91)','pattern'=>'[0-9]{10}','title'=>'(10 Digit Number)')); ?>
                        </div>
						<p class="header-title nav-inner">
                            <?php echo $this->Html->link('Back to Login',array('class' => 'swap-init','controller'=>'users', 'action'=>'login')); ?>
						</p>
                        <?php echo $this->Form->input("Proceed",array("label" => false, "div"=>false, "value" => "Proceed", "type" => "submit", "class" => "button-pri mid")); ?>
                       
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