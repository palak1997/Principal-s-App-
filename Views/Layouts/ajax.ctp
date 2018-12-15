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

<script>
            
            $(function() {
                   $(".datepicker").datepicker(
                            { 
                                dateFormat: 'dd-mm-yy',
                                changeMonth:true,
                                changeYear: true,
                                yearRange: '1988:2018'
                            }
                        );
                   $(".datepicker").keydown(false);
                   
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

<?php 

echo $this->fetch('content'); 


?>
<?php echo $this->Js->writeBuffer(); ?>