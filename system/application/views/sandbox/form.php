<?php $this->load->helper('html'); ?>
<?php $this->load->helper('form'); ?>
<h2><?=$data['pagetitle']?></h2>

<ul class="formerrorslist">
</ul>
<?php
 echo form_open($formaction);
 echo form_fieldset('Press release');
?>
<div>
<label for="title">Press Release Title</label>
<?php
$inputdata = array(
    'name'=>"title",
    'id'=>"title",
    "value"=>$formdata['title'],
    'maxlength'=>'250',
    'size'=>'40',
    );
echo form_input($inputdata);

?>
</div>
<div>
<label for="content">Release Content:</label>
<?php
$inputdata=array(
    
    'name'=>'content',
    'id'=>'content',
    'value'=>$formdata['content'],
    'rows'=>'12',
    'cols'=>'42',
    );
echo form_textarea($inputdata);
?>
</div>
<?php
echo form_fieldset_close();
$fieldsetdata = array(
    'class'=>'optionsfieldset',
    );
echo form_fieldset('Options', $fieldsetdata);
?>
<div>
<label for="active"></label>
<?php
$inputdata= array(
    'name'=>'active',
    'id'=>'active',
    'value'=>'',
    );
echo form_checkbox($inputdata);
?>
Active

</div>

<div>
<label for="sticky"></label>
Sticky
<?php
$inputdata=array(
    'name'=>'sticky',
    'id'=>'sticky',
    'value'=>'',
    );
echo form_checkbox($inputdata);
?>

</div>
<?php
echo form_fieldset_close();
echo form_submit('submit', 'Save Press Release');
echo form_close();
?>
