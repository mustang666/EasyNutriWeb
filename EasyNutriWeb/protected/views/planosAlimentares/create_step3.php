<?php
/* @var $this PlanosAlimentaresController */
/* @var $model PlanosAlimentarForm */

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/js/PlanoAlimentarForm.js',
    CClientScript::POS_END
);

$this->breadcrumbs = array(
    $model->utenteNome=>(Yii::app()->createUrl('utentes/view',array('id'=>$model->utenteId))),
    'Novo plano alimentar','Passo 1', 'Passo 2', 'Passo 3',
);



?>

<h4>Utente: <?php echo($model->utenteNome) ?></h4>

<h3>Distribuição por refeições</h3>
<p><b>NEDs estipulados:</b> <?php echo($model->neds); ?> Kcal
    <b>Peso acordado:</b> <?php echo($model->pesoAcordado); ?> Kg
</p>
<div id="formPlanoStep3">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'id' => 'formPlanoAlimentar'
    )); ?>

   <!--valores do form anterior-->
    <?php $this->renderPartial('create_hidden_field', array(
        'model' => $model,
        'passo' => 3
    ))?>
    <!--END valores do form anterior-->

    <?php if (!empty($model->errors["dosesDistribuidas"])): ?>
        <?php echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, implode('<br>', $model->errors["dosesDistribuidas"])); ?>
    <?php endif; ?>

    <div class="calculoAlimentosRef">
        <p><b><br>Cálculo das doses <font color="red">(Opcional)</font></br></b></p>

        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'tabelaAlimentoRef',
            'itemsCssClass' => 'table-bordered items',
            'dataProvider' => $tabelaQuantAlimentos,
            'summaryText' => '',
            'selectableRows' => 0,
            'columns' => array(
                array(
                    'name' => 'refeicao',
                    'header' => 'Refeição',
                    'headerHtmlOptions' => array('style' => 'width: 110px'),
                ),
                array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'leiteMG',
                    'header' => 'Leite <br>(' . $model->doses['leite'] . ' doses)',
                    'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => array(
                        'emptytext' => "0",
                    ),
                ),
                array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'vegB',
                    'header' => 'Veg. B <br>(' . $model->doses['vegB'] . ' doses)',
                    'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => array(
                        'emptytext' => "0",
                    ),
                ),
                array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'fruta',
                    'header' => 'Fruta <br> (' . $model->doses['fruta'] . ' doses)',
                    'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => array(
                        'emptytext' => "0",
                    ),
                ),
                array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'pao',
                    'header' => 'Pão e eq. <br> (' . $model->doses['pao'] . ' doses)',
                    'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => array(
                        'emptytext' => "0",
                    ),
                ),
                array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'suplementosA',
                    'header' => 'Sup. A <br>(' . $model->doses['supa'] . ' doses)',
                    'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => array(
                        'emptytext' => "0",
                    ),
                ),
                array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'carne',
                    'header' => 'Carne e eq. <br> (' . $model->doses['carne'] . ' doses)',
                    'headerHtmlOptions' => array('style' => 'width: 120px'),
                    'editable' => array(
                        'emptytext' => "0",
                    ),
                ),
                array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'gordura',
                    'header' => 'Gordura <br>(' . $model->doses['gordura'] . ' doses)',
                    'headerHtmlOptions' => array('style' => 'width: 110px'),
                    'editable' => array(
                        'emptytext' => "0",
                    ),
                ),
            ),
        ));
        ?>

        <div id="inputsTabela">
            <?php foreach ($model->dosesDistribuidas as $key => $refeicao): ?>
                <?php foreach ($model->dosesDistribuidas[$key] as $keyMacro => $macroNutri): ?>
                    <input type="hidden"
                           name="PlanoAlimentarForm[dosesDistribuidas][<?php echo $key ?>][<?php echo $keyMacro ?>]"
                           id="PlanoAlimentarForm_<?php echo $key ?>_<?php echo $keyMacro ?>"
                           value="<?php echo $macroNutri?>"/>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
        <?php echo TbHtml::formActions(array(
            TbHtml::button('Anterior', array('id' => 'btnAnterior')),
            TbHtml::submitButton('Proximo', array(
                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                'id' => 'btnSubmeter'
            )),
        )); ?>
        <?php $this->endWidget(); ?>
    </div>

    <script type="text/javascript">

        //TODO validar totais finais com os iniciais
        var dosesMacroNutri = {
            1: 0,
            2: 0,
            3: 0,
            4: 0,
            5: 0,
            6: 0,
            7: 0
        };

        var calcularTabelaDist = function(){
            for (colunas = 2; colunas <= 8; colunas++) {
                var calcTotal = 0;
                for (linhas = 1; linhas <= 6; linhas++) {
                    var valor = $('#tabelaAlimentoRef > table >tbody  tr:nth-child(' + linhas + ')>td:nth-child(' + colunas + ')').text();

                    calcTotal = calcTotal + parseFloat(valor);
                }
                console.log(calcTotal);
                $('#tabelaAlimentoRef > table >tbody  tr:nth-child(7)>td:nth-child(' + colunas + ')').text(calcTotal.toFixed(1));
            }
        };


        $(document).ready(function () {
            //limpa a ultima linha da tabela
            for (coluna = 2; coluna <= 8; coluna++) {
                $('#tabelaAlimentoRef > table >tbody  tr:last-child td:nth-child(' + coluna + ')').empty();
            }
            //muda a cor da ultima linha para azul claro
            $('#tabelaAlimentoRef > table >tbody  tr:last-child td').css('background-color', 'lightblue');

            //inicializa a tabela com valores caso ja tenho sido definidos
            $('tbody tr').each(function (indexLinha) {

                $(this).find('td').each(function (indexColuna) {

                    if (indexColuna == 0 || indexLinha ==6) {
                        return;
                    }
                    var refeicaoId = indexLinha + 1;
                    var child = indexLinha * 7 + indexColuna;
                    var hiddenFieldVal = $('#inputsTabela input:nth-child(' + child + ')').val();
                    $(this).find('a').text(hiddenFieldVal);
//                        console.log("Linha", indexLinha, "Coluna", indexColuna,"Child",child,
//                             "hiddenVal",hiddenFieldVal);
                });
            });
            calcularTabelaDist();

            //calcula todos os totais quando se muda um valor
            $('#tabelaAlimentoRef table >tbody tr>td').change(function () {
                    setTimeout(function () {
                        calcularTabelaDist();
                    }, 200);
                }
            );

            $('#formPlanoAlimentar').submit(function () {
                $('tbody tr').each(function (indexLinha) {
                    $(this).find('td').each(function (indexColuna) {

                        if (indexColuna == 0) {
                            return;
                        }
                        var refeicaoId = indexLinha + 1;
                        var cellValue = $(this).text();
                        var child = indexLinha * 7 + indexColuna;
                        var hiddenField = $('#inputsTabela input:nth-child(' + child + ')');
                        hiddenField.val(cellValue);
//                        console.log("Linha", indexLinha, "Coluna", indexColuna,"Child",child,
//                            "Value", cellValue, "hidden",hiddenField);
                    });
                });
            });

        });

    </script>