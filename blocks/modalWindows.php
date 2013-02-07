<script>
    $(function () {
        $("#login").dialog({
            autoOpen:false,
            width:300,
            height:220,
            modal:true,
            buttons:{ "Войти":function () {
                $(this).dialog("close");
            }, "Отмена": function () {
                $(this).dialog("close");
            }}
        });
    });
</script>
<div id="login" title="Вход в личный кабинет">
        <div class="form-title">Email</div>
        <input class="form-field" type="text" name="firstname" /><br />
        <div class="form-title">Пароль</div>
        <input class="form-field" type="text" name="email" /><br />
        <div class="submit-container">
        </div>
</div>


<?php
if ($_GET['action'] == 'calc' AND $_GET['type'] == 0)
{
?>
    <script>
        $(function () {
            $("#addNewAdditionalStructure").dialog({
                autoOpen:false,
                width:300,
                height:180,
                modal:true,
                buttons:{ "Добавить":function () {
                    var structuresQuantity = $('[id^="villaggioAdditionalStruct"]').length;
                    var html = '<div class="grid_label">' +
                            '<div>' +
                            '<input class="boxCheckbox" onclick="doSliderCheckbox(this, \'villaggioAdditionalStruct[' + structuresQuantity + '][value]\');" name="villaggioAdditionalStruct[' + structuresQuantity + '][name]" type="checkbox" value="1"/> ' + $('#structureName').val() +
                            '<input type="hidden" name="villaggioAdditionalStruct[' + structuresQuantity + '][fieldName]" value="' + $('#structureName').val() + '"> ' +
                            '</div>' +
                            '</div>' +
                            '<div class="r1">' +
                            '<img src="/images/left_arrow.png" class="arrows_button" align="absbottom" onclick="counter_down(\'villaggioAdditionalStruct[' + structuresQuantity + '][value]\',1000);"  alt="left"/>' +
                            '<input name="villaggioAdditionalStruct[' + structuresQuantity + '][value]" class="arrow_input" type="text" id="villaggioAdditionalStruct[' + structuresQuantity + '][value]" value="50000" disabled="disabled">' +
                            '<img src="/images/right_arrow.png" class="arrows_button" align="absbottom" onclick="counter_up(\'villaggioAdditionalStruct[' + structuresQuantity + '][value]\',1000);"  alt="right"/>' +
                            '</div>';

                    $(html).appendTo('#additionalStructures');
                    //structuresQuantity++;
                    ConvertAllCheckbox();
                    $(this).dialog("close");
                } }
            });
        });
    </script>
    <div id="addNewAdditionalStructure" title="Введите название строения">
        <p><input type="text" name="structureName" id="structureName" value=""></p>
    </div>
<?php
}

if ($_GET['action'] == 'calc' AND $_GET['type'] == 3 AND (!isset($_GET['step']) OR $_GET['step'] == 1))
{

    $carsMarks = dbGetCarsMarks();
    ?>
<script>
    $(function () {
        $("#selectCarMark").dialog({
            autoOpen:false,
            width:700,
            height:500,
            modal:true
        });
    });
</script>
<div id="selectCarMark" title="Выберите марку автомобиля">
<?php

        $firstLetter = null;
        foreach ($carsMarks as $id => $carMark)
        {
            if ($firstLetter == null OR $firstLetter != mb_substr($carMark,0,1,'UTF-8'))
            {
                if ($firstLetter != null)
                    echo '</ul></br>';
                $firstLetter = mb_substr($carMark,0,1,'UTF-8');
                echo "<h3 class='orange inline'>{$firstLetter}</h3>";
                echo "<ul><li><a href='#' onclick='selectCarMark({$id}, \"{$carMark}\")' style='text-decoration: underline;'>{$carMark}</a></li>";
            }
            else
                echo "<li><a href='#' onclick='selectCarMark({$id}, \"{$carMark}\")' style='text-decoration: underline;'>{$carMark}</a></li>";
        }
        echo '</ul>';
?>
</div>

<!-- Models -->
<script>
    $(function () {
        $("#selectCarModel").dialog({
            autoOpen:false,
            width:700,
            height:500,
            modal:true
        });
    });
</script>
<div id="selectCarModel" title="Выберите модель автомобиля">
</div>

<!-- Modifications -->
<script>
    $(function () {
        $("#selectCarModification").dialog({
            autoOpen:false,
            width:700,
            height:500,
            modal:true
        });
    });
</script>
<div id="selectCarModification" title="Выберите модификацию автомобиля">
</div>

<!-- Years -->
<script>
    $(function () {
        $("#selectStartYear").dialog({
            autoOpen:false,
            width:700,
            height:500,
            modal:true
        });
    });
</script>
<div id="selectStartYear" title="Выберите год начала эксплуатации автомобиля">
<h3 class='orange inline'>Год начала эксплуатации автомобиля</h3>
    <ul>
        <li><a href='#' onclick='selectStartYear(<?=intval(date("Y"))?>, "Новое ТС")' style='text-decoration: underline;'>Новое ТС</a></li>

    <?php
        $startYear = intval(date("Y"));
        $stopYear = intval(date("Y"))-8;
    for ($year=$startYear; $year>$stopYear; $year--)
    {
        echo "<li><a href='#' onclick='selectStartYear({$year}, {$year})' style='text-decoration: underline;'>{$year}</a></li>";
    }
?>
    </ul>
</div>

<!--FormOfCompensation-->
<script>
    $(function () {
        $("#selectFormOfCompensation").dialog({
            autoOpen:false,
            width:700,
            height:500,
            modal:true
        });
    });
</script>
<div id="selectFormOfCompensation" title="Выберите форму возмещения">
<h3 class='orange inline'>Форма возмещения</h3>
    <ul>
        <li style="padding-bottom: 5px"><a onclick='selectFormOfCompensation(1, "Ремонт на СТОА официального дилера")' style='text-decoration: underline; cursor: pointer'>Ремонт на СТОА официального дилера</a></li>
        <li style="padding-bottom: 5px"><a onclick='selectFormOfCompensation(2, "Ремонт на СТОА неофициального дилера")' style='text-decoration: underline; cursor: pointer'>Ремонт на СТОА неофициального дилера</a></li>
        <li style="padding-bottom: 5px"><a onclick='selectFormOfCompensation(3, "Выплата по калькуляции Страховщика")' style='text-decoration: underline; cursor: pointer'>Выплата по калькуляции Страховщика</a></li>
        <li style="padding-bottom: 5px"><a onclick='selectFormOfCompensation(4, "Ремонт на СТОА Страхователя")' style='text-decoration: underline; cursor: pointer'>Ремонт на СТОА Страхователя</a></li>
    </ul>
</div>
<?php
}
elseif ($_GET['action'] == 'calc' AND $_GET['type'] == 3 AND (!isset($_GET['step']) OR $_GET['step'] == 2))
{
    ?>

<!--Franchise-->

<script>
    $(function () {
        $("#selectLiability").dialog({
            autoOpen:false,
            width:700,
            height:500,
            modal:true
        });
    });
</script>
<div id="selectLiability" title='Выберите размер компенсации по страховому случаю "Гражданская ответственность"'>
    <h3 class='orange inline'>Франшиза</h3>
    <ul>
        <li><a href='#' onclick='selectLiability(300000)' style='text-decoration: underline;'>300 000 руб.</a></li>
        <li><a href='#' onclick='selectLiability(500000)' style='text-decoration: underline;'>500 000 руб.</a></li>
        <li><a href='#' onclick='selectLiability(750000)' style='text-decoration: underline;'>750 000 руб.</a></li>
        <li><a href='#' onclick='selectLiability(1000000)' style='text-decoration: underline;'>1 000 000 руб.</a></li>
        <li><a href='#' onclick='selectLiability(1250000)' style='text-decoration: underline;'>1 250 000 руб.</a></li>
        <li><a href='#' onclick='selectLiability(1500000)' style='text-decoration: underline;'>1 500 000 руб.</a></li>
        <li><a href='#' onclick='selectLiability(1750000)' style='text-decoration: underline;'>1 750 000 руб.</a></li>
        <li><a href='#' onclick='selectLiability(2000000)' style='text-decoration: underline;'>2 000 000 руб.</a></li>
        <li><a href='#' onclick='selectLiability(2500000)' style='text-decoration: underline;'>2 500 000 руб.</a></li>
        <li><a href='#' onclick='selectLiability(3000000)' style='text-decoration: underline;'>3 000 000 руб.</a></li>
    </ul>
</div>


<script>
    $(function () {
        $("#selectAccident").dialog({
            autoOpen:false,
            width:700,
            height:500,
            modal:true
        });
    });
</script>
<div id="selectAccident" title='Выберите размер компенсации по страховому случаю "Несчастный случай"'>
    <h3 class='orange inline'>Франшиза</h3>
    <ul>
        <li><a href='#' onclick='selectAccident(100000)' style='text-decoration: underline;'>100 000 руб.</a></li>
        <li><a href='#' onclick='selectAccident(200000)' style='text-decoration: underline;'>200 000 руб.</a></li>
        <li><a href='#' onclick='selectAccident(300000)' style='text-decoration: underline;'>300 000 руб.</a></li>
        <li><a href='#' onclick='selectAccident(400000)' style='text-decoration: underline;'>400 000 руб.</a></li>
        <li><a href='#' onclick='selectAccident(500000)' style='text-decoration: underline;'>500 000 руб.</a></li>
        <li><a href='#' onclick='selectAccident(750000)' style='text-decoration: underline;'>750 000 руб.</a></li>
        <li><a href='#' onclick='selectAccident(1000000)' style='text-decoration: underline;'>1 000 000 руб.</a></li>
    </ul>
</div>
<script>
    $(function () {
        $("#selectFranchise").dialog({
            autoOpen:false,
            width:700,
            height:500,
            modal:true
        });
    });
</script>
<div id="selectFranchise" title="Выберите франшизу">
<h3 class='orange inline'>Франшиза</h3>
    <ul>
        <li><a href='#' onclick='selectFranchise(6000, "6,000 руб.")' style='text-decoration: underline;'>6,000 руб.</a></li>
        <li><a href='#' onclick='selectFranchise(9000, "9,000 руб.")' style='text-decoration: underline;'>9,000 руб.</a></li>
        <li><a href='#' onclick='selectFranchise(15000, "15,000 руб.")' style='text-decoration: underline;'>15,000 руб.</a></li>
        <li><a href='#' onclick='selectFranchise(30000, "30,000 руб.")' style='text-decoration: underline;'>30,000 руб.</a></li>
    </ul>
</div>
    <?php
}
?>