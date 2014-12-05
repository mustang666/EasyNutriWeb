<?php
/* @var $this PlanosAlimentaresController */
/* @var $model PlanosAlimentarForm */
/* @var $refeicoes TiposRefeicao */


Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/js/PlanoAlimentarForm.js',
    CClientScript::POS_END
);


$this->breadcrumbs = array(
    'Passo 1', 'Passo 2', 'Passo 3', 'Passo 4',
);

?>

<h4>Utente: <?php echo($model->utenteNome) ?></h4>
<h3>Plano Alimentar</h3>
<div id="formPlanoStep3">
    <!--    --><?php //$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    //        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    //        'id' => 'formPlanoAlimentar'
    //    ));
    ?>
    <?php echo TbHtml::beginFormTb(); ?>
    <!--valores do form anterior-->
    <input type="hidden" id="passoAtual" name="passoAtual" value="4">
    <input type="hidden" id="irPara" name="irPara" value="4">


    <input type="hidden" name="PlanoAlimentarForm[actividade]" id="PlanoAlimentarForm_actividade"
           value="<?php echo($model->actividade); ?>">
    <input type="hidden" name="PlanoAlimentarForm[pesoAtual]" id="PlanoAlimentarForm_pesoAtual"
           value="<?php echo($model->pesoAtual); ?>">
    <input name="PlanoAlimentarForm[altura]" id="PlanoAlimentarForm_altura" type="hidden"
           value="<?php echo($model->altura); ?>">
    <input name="PlanoAlimentarForm[pesoAcordado]" id="PlanoAlimentarForm_pesoAcordado" type="hidden"
           value="<?php echo($model->pesoAcordado); ?>">
    <input type="hidden" id="PlanoAlimentarForm_neds" name="PlanoAlimentarForm[neds]"
           value="<?php echo($model->neds); ?>">
    <input type="hidden" id="PlanoAlimentarForm_restricaoNeds" name="PlanoAlimentarForm[restricaoNeds]"
           value="<?php echo($model->restricaoNeds); ?>">
    <input type="hidden" name="PlanoAlimentarForm[utenteId]" id="PlanoAlimentarForm_utenteId"
           value="<?php echo($model->utenteId); ?>">
    <input type="hidden" name="PlanoAlimentarForm[utenteNome]" id="PlanoAlimentarForm_utenteNome"
           value="<?php echo($model->utenteNome); ?>">
    <input type="hidden" name="PlanoAlimentarForm[sexo]" id="PlanoAlimentarForm_sexo"
           value="<?php echo($model->sexo); ?>">
    <!--END valores do form anterior-->


    <div id="detalhesPlanoAlimentar">
        <?php foreach ($refeicoes as $refeicao): ?>
            <div id="<?php echo('refeicao' . $refeicao->id); ?>">
                <h4><?php echo($refeicao->descricao) ?></h4>
                <p>Hora:
                <?php
                $this->widget('editable.Editable', array(
                    'type' => 'combodate',
                    'name' => 'horasRefeicao[' . $refeicao->id . ']',
                    'text' => date('H:i', strtotime($model->horasRefeicao[$refeicao->id])),
                    'placement' => 'right',
                    'format' => 'YYYY-MM-DD HH:mm', //in this format date sent to server
                    'viewformat' => 'HH:mm', //in this format date is displayed
                    'template' => 'HH:mm', //template for dropdowns
                    'combodate' => array('minYear' => 1980, 'maxYear' => 2013),
                ));
                ?></p>
                <br>

                <div class="linhasRefeicao">
                    <div class="linhaPlano">
                        <?php echo TbHtml::textField('PlanoAlimentarForm[alimentos][' . $refeicao->id . '][]', ''); ?>

                        <?php echo TbHtml::button('x',
                            array(
                                'class' => 'btnApagarLinha',
                                'color' => TbHtml::BUTTON_COLOR_DANGER,
                            )); ?>
                        <br>
                    </div>
                </div>
                <?php echo TbHtml::button('Adicionar alimento',
                    array(
                        'class' => 'btnAbrirModal',
                        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                        'data-toggle' => 'modal',
                        'data-target' => '#modalPesquisa',)); ?>

            </div>
        <?php endforeach; ?>

    </div>

    <br>
    <?php echo TbHtml::button('Anterior', array('id' => 'btnAnterior')); ?>
    <?php echo TbHtml::submitButton('Guardar', array(
        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
        'id' => 'btnSubmeter')); ?>


    <?php echo TbHtml::endForm(); ?>

    <?php $this->widget('bootstrap.widgets.TbModal', array(
        'id' => 'modalPesquisa',
        'backdrop'=>true,
        'header' => 'Pesquisar Alimento',
        'content' => '',
        'footer' => array(
            TbHtml::button('Adicionar', array(
                'id' => 'addAlimento',
                'data-dismiss' => 'modal',
                'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            TbHtml::button('Close', array('data-dismiss' => 'modal')),
        ),
    )); ?>
</div>

<script type="text/javascript">

    var pesquisarAlimento = function (query) {
        $.ajax({
            type: 'GET',
            url: '<?php echo Yii::app()->createAbsoluteUrl("planosAlimentares/popularModal&query="); ?>' + query,
            success: function (data) {
                $('#modalPesquisa div.modal-body').html(data);
                var inputText =$('#queryAlimento');
                inputText.focus();
                inputText.val(inputText.val());
                inputText.keyup(function () {
                    var queryVal = inputText.val();
                    pesquisarAlimento(queryVal);
                    console.log("a pesquisar", queryVal);
                });
            },
            error: function (data) { // if error occured
                alert("Ocorreu um erro");
            },
            dataType: 'html'
        });
    }

    $(document).ready(function () {
        pesquisarAlimento();


        var divLinhasRefeicao = null;
        var divLinhaHtml = null;
        var divProprio;
        //guardar div que foram clicados
        $('.btnAbrirModal').click(function () {

            divLinhasRefeicao = $(this).parent().find('.linhasRefeicao');
            console.log("divLinhasRefeicao", divLinhasRefeicao);
            divProprio = $(this).parent();
            divLinhaHtml = $(this).parent().children().find('div');
//            console.log('divLinhaHtml',divLinhaHtml);
            divLinhaHtml = divLinhaHtml.get(0).outerHTML;
            console.log('divLinhaHtml.OuterHtml', divLinhaHtml);

            //  console.log(divProprio,divPai,divLinhaHtml);
        });
        //adicona nova linha quando é adicionado um alimento
        $('#addAlimento').click(function () {
            // divLinhaHtml.insertBefore(divLinhaHtml.lastChild());
            divLinhasRefeicao.append(divLinhaHtml);
        });
        //remove linha
        $('.btnApagarLinha').live("click", function () {
            divLinhasRefeicao = $(this).parent().parent();
//            console.log("apagar", divLinhasRefeicao);
            var count = divLinhasRefeicao.get(0).childElementCount
//            console.log("total antes apagar:",count);
            if(count>1){
//                console.log("remover linha",this);
                $(this).parent().remove();
            }else{
//                console.log("LIMPAR",divLinhasRefeicao.find('input'));
                divLinhasRefeicao.find('input').val('');
            }
        });

    });


</script>