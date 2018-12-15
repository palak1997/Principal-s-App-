
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
	Login | Radical Logix
	</title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  	<meta name="HandheldFriendly" content="true">

  	<script type='text/javascript' src='https://www.google.com/jsapi'></script>

	<?php
	
	echo $this->Html->meta('icon');

    echo $this->Html->css('loginstyles');

	echo $this->Html->script(array('jquery','jquery-ui'));
            
        
    echo $this->Html->css('flick_jquery/jquery-ui');

    echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
                
    echo $scripts_for_layout;
                
        
?>

</head>
<body class="member dark" id="member-login">
    <?php echo $this->Session->flash('flash', array('element' => 'wrongpassword')); ?>
    <div id="main_header" class="main_header">
	<div id="actions">
		<ul class="actionCont logo" id="logo">
			<li class="actionItem">
                        
                        <?php echo $this->Session->flash(); ?>
	
                        </li>
		</ul>
		
		<ul class="actionCont logout" id="logout">
			<li class="actionItem">
                            
                            <span class="icon-user"></span>
			</li>
		</ul>
		
	</div>
    </div>

    
    <?php echo $this->fetch('content'); ?>

    <?php echo $this->Js->writeBuffer(); ?>
     
</body>

</html>