<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
	Radical Logix
	</title>
        <script type='text/javascript' src='https://www.google.com/jsapi'></script>

	<?php
		echo $this->Html->meta('icon');

    echo $this->Html->css('header_style');
                
    echo $this->Html->css('styles');

    echo $this->Html->css('foundation');
    
    echo $this->fetch('meta');
		
    echo $this->Html->script(array('jquery','jquery-ui','pace'));
            
        
    echo $this->Html->css('flick_jquery/jquery-ui');

    echo $this->Html->script('jquery.dataTables');
    echo $this->Html->script('dataTables.foundation');

    echo $this->Html->css('dataTables.foundation');
    echo $this->Html->css('foundation');
    
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
                
    echo $scripts_for_layout;
                
        
        ?>
    
        <script>
            
            $(function() {
                   $(".datepicker").datepicker(
                            { 
                                dateFormat: 'dd-mm-yy',
                                changeMonth:true,
                                changeYear: true,
                                yearRange: '1948:2028'
                            }
                        );
                   $(".datepicker").keydown(false);

                   $(".keydatepicker").datepicker(
                            { 
                                dateFormat: 'dd-mm-yy',
                                changeMonth:true,
                                changeYear: true,
                                yearRange: '1948:2028'
                            }
                        );
                   
                   $('.form_button').click(function (){
                        $(this).css('background-color',"#68b12f");
                   });

                   $('.searchtable').DataTable( {
                        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        "deferRender": true
                   });

                   $('.searchtableform').DataTable( {
                        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        "deferRender": true,
                        "searching": false, "paging": false,
                        "bInfo" : false
                   });
                    
                  //$(".datepicker").keypress(function(event) {event.preventDefault();});
            });

            $(document).ready(function(){
              $("form").submit(function(event) {
                if(navigator.onLine==false) {  
                  //alert("Sorry, can't process request. Check your internet connection");
                  //return false;
                }
                else {    
                  if($(this).attr('target') !='_blank'){
                    //$(this).find('input[type=submit]').attr('disabled', 'disabled');
                    //$(this).find('input[type=submit]').attr('value', 'Submitting..');
                  }
                  return true;
                }
              })
            });
            
        </script>
</head>
<body>
<div id="container">
    
    <!------------ Header ---------------->

    <header id="uHeader">
      <hgroup style="height:3.5px;">
        <!--<a href="#" id="uLogo"><span >RADICAL LOGIX</span></a>
        <div class="userBlock">
          <img src="f_spacer.gif" class="navIcon user" alt="">
          <span>Welcome <?php echo $current_user['username']; ?></span>
           <?php echo $this->Html->link('Logout',array('controller'=> 'users', 'action' => 'logout')); ?>
        </div>-->
      </hgroup>
      
    </header>
    <div id="uBreadcrumbs" >
      
      <div class="uBreadcrumbsBG">
        <div class="uLeft"><
        </div>
        <div class="uRight">
              
          
        </div>
      </div>
    </div>

   

    <div id="content">

	     <?php echo $this->Session->flash(); ?>

       	<?php echo $this->fetch('content'); ?>
    </div>

    <?php echo $this->Js->writeBuffer(); ?>
</div>

</body>
</html>

