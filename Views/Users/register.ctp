<?php echo $this->Form->create('Schooldetail');?>
<div class="main_content" id="main_content">
    
    <div id="p2list">
        <div class="widgets">
            
            <div class="widget-list">
                <div class="formc" style="width: 90%;">
                    
                    <center><div class="form-header" style="font-weight: bold;">Register Here</div></center>

                    <hr width="50%" color="#f1f1f1" style="margin-top:6px; margin-bottom:6px;"/>


		        </div><center>
                <div class="middle-inputtext">
                        <label>School Name</label>
                        <?php echo $this->Form->input('name',array('label' => false,'div'=>false,'placeholder' => 'Name', 'type' => 'text'));?>
                        
                
                </div></center><br>
               <center> <div class="middle-inputtext">
                        <label>Email</label>
                        <?php echo $this->Form->input('email',array('label' => false,'div'=>false,'placeholder' => 'Email', 'type' => 'text'));?>
                        
                
                </div></center><br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('address_line_1',array('label' => '  Addresss_line_1   ','placeholder' => 'Address', 'type' => 'text'));?>
                        
                
                </div></center><br>
                <center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('address_line_2',array('label' => '  Address_line_2   ','placeholder' => 'Address', 'type' => 'text'));?>
                        
                
                </div></center><br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('street',array('label' => '  Street   ','placeholder' => 'Street', 'type' => 'text'));?>
                        
                
                </div></center><br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('city',array('label' => '  City   ','placeholder' => 'City', 'type' => 'text'));?>
                        
                
                </div></center><br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('state',array('label' => '  State   ','placeholder' => 'State', 'type' => 'text'));?>
                        
                
                </div></center>
                <br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('country',array('label' => '  Country   ','placeholder' => 'Country', 'type' => 'text'));?>
                        
                
                </div></center>
                <br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('pincode',array('label' => '  Pincode   ','placeholder' => 'Pincode', 'type' => 'text'));?>
                        
                
                </div></center>
                <br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('board',array('label' => '  Board   ','placeholder' => 'Board', 'type' => 'text'));?>
                        
                
                </div></center><br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('phone',array('label' => '  Phone   ','placeholder' => 'Phone', 'type' => 'text'));?>
                        
                
                </div></center><br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('currency',array('label' => '  Currency   ','placeholder' => 'Currency', 'type' => 'text'));?>
                        
                
                </div></center><br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('affiliation_no',array('label' => '  Affiliation_no   ','placeholder' => 'affiliation_no', 'type' => 'text'));?>
                        
                
                </div></center><br>
                <center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->input('schoolcode',array('label' => '  School_Code   ','placeholder' => 'Code', 'type' => 'text'));?>
                        
                
                </div></center><br><center>
                <div class="middle-inputtext">
                        
                        <?php echo $this->Form->end('REGISTER');?>
                        
                
                </div></center>
            </div>
        </div>
    </div>
</div>

                    

		
       