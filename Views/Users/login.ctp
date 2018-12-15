<section class="autocenter" data-offset-y="-20">
	<br/>
	<h1>
		<?php echo $this->Html->image('logo.png', array('alt' => 'Radical Logix', 'height' => '100px')); ?>
	</h1>
	<div id="login-form" class="active">
		<h2 class="header-title" style="font-weight:bold; color:#26477e; font-size: 11px;">(CBSE Result Analysis Portal)</h2>
		<?php echo $this->Form->create(); ?>
                        <div id="text_data">
			<div class="form-field">
                                <?php echo $this->Form->input('username',array('type' => 'text', 'label' => false,'div' => false,'class' => 'wide icon-user', 'placeholder' => 'Username')); ?>
                        </div>
			<div class="form-field">
			        <?php echo $this->Form->input('password',array('label' => false,'div' => false,'class' => 'wide', 'placeholder' => 'Password')); ?>
                        </div>
			</div>
			<p class="header-title nav-inner">
				<?php //echo $this->Html->link('Forgot your password?',array('controller'=>'users', 'action'=>'forgotpassword')); ?>
			</p>
			<?php echo $this->Form->input("Login",array("label" => false, "div"=>false, "value" => "Login", "type" => "submit", "class" => "button-pri mid")); ?>
			<?php echo $this->Html->link('Register', array('controller' => 'users','action' => 'register'),array("label" => false, "div"=>false, "value" => "Register", "class" => "button-pri mid",'rule' => 'button')); ?>
                       
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
