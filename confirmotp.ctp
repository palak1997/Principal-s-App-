<script type="text/javascript">
    $(function () {
        $('.password-mismatch').hide();


        $("#confirmotp").submit(function () {
            var password = $("#password").val();
            var confirmPassword = $("#repassword").val();
            if (password != confirmPassword) {
                $('.password-mismatch').show();
                return false;
            }
            return true;
        });
    });
</script>

<section class="autocenter" data-offset-y="-20">
	<br/>
	<h1>
		<?php echo $this->Html->image('logo.png', array('alt' => 'Radical Logix', 'height' => '100px')); ?>
	</h1>
	<div id="reset-form" class="swap active">
		<h2 class="header-title" style="color:#26477e;">Step 3. Set New Password</h2>
		<p class="instructions" style="text-align:justify; color:#000000;">Set New Password. ( Do Not Close or Refresh the browser )</p>
		<?php echo $this->Form->create("User",array('action' => 'savepassword','id'=>'confirmotp')); ?>

						<?php echo $this->Form->input('username', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => $userinfo['username'])); ?>
						<?php echo $this->Form->input('h', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => $userinfo['encryptedusername'])); ?>

						<div class="form-field">
                            <?php echo $this->Form->input('password',array('label' => false,'class' => 'wide mail-check','style' => 'width:300px; ', 'placeholder' => 'Password','type'=>'password','id'=>'password')); ?>
                        </div>

                        <div class="form-field">
                            <?php echo $this->Form->input('repassword',array('label' => false,'class' => 'wide mail-check','style' => 'width:300px; ', 'placeholder' => 'Confirm Password','type'=>'password','id'=>'repassword')); ?>
                        </div>

                        <div class='middle-inputtext password-mismatch'>
	                        <label style="width: 500px; color: #ff0000;"><i>*Password & Confirm Password do not match</i></label>
	                    </div>

	                    <br/>
						<?php echo $this->Form->input("Change Password",array("label" => false, "div"=>false, "value" => "Proceed", "type" => "submit", "class" => "button-pri mid")); ?>
                       
                <?php echo $this->Form->end(); ?>
		
	</div>
    <span id="alertmessage">
        
    </span>
</section>

<footer>
	<div class="footer_copyright">Powered By © <a href="http://www.radicallogix.com" target="_blank">Radical Logix</a>. All Rights Reserved.</div>
	<div class="footer_sitelinks">
		<ul>
	    	<li style="font-weight:bold; color:#26477e;"><u>Note</u> : Use Latest Version of Browsers, Preferably (Google Chrome or Mozilla Firefox)</li>
	    </ul>
	</div>
</footer>