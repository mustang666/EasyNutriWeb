<?php
/* @var $this RefeicoesController */
/* @var $model Refeicoes */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'refeicoes-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'diario_id'); ?>
        <?php echo $form->textField($model, 'diario_id'); ?>
        <?php echo $form->error($model, 'diario_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'tipo_refeicao_id'); ?>
        <?php echo $form->textField($model, 'tipo_refeicao_id'); ?>
        <?php echo $form->error($model, 'tipo_refeicao_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'data_refeicao'); ?>
        <?php echo $form->textField($model, 'data_refeicao'); ?>
        <?php echo $form->error($model, 'data_refeicao'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Guardar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->