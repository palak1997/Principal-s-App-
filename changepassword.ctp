<div class="vertical_menu" id="vertical_menu">
    
    <div id="menuscrollstyle" class="menuscrollbar">

        <?php echo $this->element('sidemenu',array("submodules_data" => $submodules_data,"active_submodule" => $active_submodule)); ?>

    </div>

</div>

<?php echo $this->Form->create('User', array('type' => 'file')); ?>

<div class="main_content" id="main_content">
    <?php if ($success=='1') { 
                echo $this->element('success',array('success_message'=>'Password Updated Successfully'));
            }
            else if ($success=='2') {
                echo $this->element('failure',array('failure_message'=>'Error Updating Password'));
            }
    ?>
    
    <div id="p2list" style='width:960px;'>
        <div class="widgets">
            <div class="widget-list">
		
                <div class="formc">
				
                    <div class="form-header"><b>Change Password</b> </div>
					
                    <hr width="100%" color="#f1f1f1" style="margin-top:6px; margin-bottom:6px;"/>
			
                    <div class="middle-inputtext">
                        <label>Current Password</label>
                        <?php echo $this->Form->input('current_password',array('div'=>false,'label'=>false,'type'=>'password','placeholder'=>'Old Password','required'=>true)); ?>
                    </div>
                    
                    <div class="middle-inputtext">
                        <label>New Password</label>
                        <?php echo $this->Form->input('password',array('div'=>false,'label'=>false,'type'=>'password','placeholder'=>'New Password','required'=>true)); ?>
                    </div>
                    
                    <div class="middle-inputtext">
                        <label>Confirm Password</label>
                        <?php echo $this->Form->input('password2',array('div'=>false,'label'=>false,'type'=>'password','placeholder'=>'Confirm Password','required'=>true)); ?>
                    </div>
                    <br/>
                    <div class=''>
                        <?php echo $this->Form->input('Save & Continue',array('div'=>false,'label'=>false,'type'=>'submit','class'=>'form_button')); ?>
                    </div>
                    
                </div>
                
                <?php echo $this->Form->end(); ?>
                                
            </div>
            
        </div>
    </div>
    
    <br/>
    <br/>
            
</div>