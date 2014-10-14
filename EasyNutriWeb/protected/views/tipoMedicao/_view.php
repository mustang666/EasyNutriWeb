<?php
/* @var $this TipoMedicaoController */
/* @var $data TipoMedicao */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
    <?php echo CHtml::encode($data->descricao); ?>
    <br/>


</div>