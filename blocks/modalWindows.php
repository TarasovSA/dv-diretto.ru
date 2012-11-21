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

if ($_GET['action'] == 'calc' AND $_GET['type'] == 3)
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
<?php
}
?>