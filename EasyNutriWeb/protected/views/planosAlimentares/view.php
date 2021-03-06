<?php
/* @var $this PlanosAlimentaresController */
/* @var $model PlanosAlimentares */
/* @var $dpLinhasPlano LinhasPlano */
/* @var $planoAlimentarUtente PlanosAlimentares */

//$this->breadcrumbs=array(
//	'Planos Alimentares'=>array('index'),
//	$model->Id,
//);
//
//
//$this->menu=array(
//	array('label'=>'List PlanosAlimentares', 'url'=>array('index')),
//	array('label'=>'Create PlanosAlimentares', 'url'=>array('create')),
//	array('label'=>'Update PlanosAlimentares', 'url'=>array('update', 'id'=>$model->Id)),
//	array('label'=>'Delete PlanosAlimentares', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage PlanosAlimentares', 'url'=>array('admin')),
//);
//
?>
<div class="hideInPrint" >
    <?php echo
    TbHtml::button('Imprimir', array('id' => 'btnImprimir', 'icon'=>'print', 'onClick'=>'js:window.print();'));
    ?>
</div>
<div id="propriedadesPlanoAlimentar">
    <div id="dataPrescricao">
        <?php echo TbHtml::label('Data de Prescrição:', 'text', array('id' => 'labelPrescData')); ?>
        <?php echo TbHtml::uneditableField(date("Y-m-d", strtotime($planoAlimentarUtente->data_presc)), array('id' => 'textPrescData')); ?>
    </div>
    <div id="nedsPlanoAlimentar" class="hide">
        <?php echo TbHtml::label('NEDs:', 'text', array('id' => 'labelNed')); ?>
        <?php echo TbHtml::uneditableField($planoAlimentarUtente->ned.' kcal', array('id' => 'textNed')); ?>
    </div>
    <div id="apresentaTabela" class="hide">
        <?php echo TbHtml::checkBox('apresentaTabela', ($planoAlimentarUtente->apresentaTabela == 1) ? true : false, array('label' => 'Pode ver tabela de equivalências', 'disabled' => true)); ?>
    </div>

</div>
<?php
$this->widget('ext.groupgridview.BootGroupGridView', array(
    'id' => 'grid1',
    'type' => TbHtml::GRID_TYPE_BORDERED,
    'dataProvider' => $dpLinhasPlano,
    'template' => '{items}{pager}',
    'enablePagination' => false,
    'mergeColumns' => array('Refeicao', 'Hora'),
    'summaryText' => '',
    'enableSorting' => false,
    'columns' => array(
        array(
            'name' => 'Refeicao',
            'value' => '$data->refeicao',
            'htmlOptions' => array('style' => 'width: 130px;'),
        ),
        array(
            'name' => 'Hora',
            'value' => 'date("H:i", strtotime($data->hora))',
            'htmlOptions' => array('style' => 'width: 80px;'),
        ),

        'descricao',

    ),
));
?>
<div id="prescricaoDietetica">
    <?php echo TbHtml::label('Recomendações', 'text', array('id' => 'labelPrescDietetica')); ?>
    <?php echo TbHtml::uneditableField($planoAlimentarUtente->recomendacoes, array('id' => 'textPrescDietetica')); ?>
</div>

