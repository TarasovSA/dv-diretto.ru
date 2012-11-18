function villaggioUpdateFirstPage()
{
    var constructionEl = $('#villaggio\\[constructionEl\\]').val();
    var isExteriorTrim = $('[name="villaggio\\[isExteriorTrim\\]"]').is(':checked');
    var exteriorTrim = $('#villaggio\\[exteriorTrim\\]').val();
    var isInteriorTrim = $('[name="villaggio\\[isInteriorTrim\\]"]').is(':checked');
    var interiorTrim = $('#villaggio\\[interiorTrim\\]').val();
    var isEngineeringSystems = $('[name="villaggio\\[isEngineeringSystems\\]"]').is(':checked');
    var engineeringSystems = $('#villaggio\\[engineeringSystems\\]').val();
    var isProperty = $('[name="villaggio\\[isProperty\\]"]').is(':checked');
    var property = $('#villaggio\\[property\\]').val();
    var isLiability = $('[name="villaggio\\[isLiability\\]"]').is(':checked');
    var liability = $('#villaggio\\[liability\\]').val();
    var isLandscape = $('[name="villaggio\\[isLandscape\\]"]').is(':checked');
    var landscape = $('#villaggio\\[landscape\\]').val();

    var otherStructures = [];
    var quantityOfOtherStructures = 0;

    while (1)
    {
        var temp = $('[name=villaggioAdditionalStruct\\['+ quantityOfOtherStructures + '\\]\\[name\\]]').val();
        if (temp)
        {
            otherStructures[quantityOfOtherStructures] = {};
            otherStructures[quantityOfOtherStructures].name = $('[name=villaggioAdditionalStruct\\['+ quantityOfOtherStructures + '\\]\\[name\\]]').is(':checked');
            otherStructures[quantityOfOtherStructures].value = $('[name=villaggioAdditionalStruct\\['+ quantityOfOtherStructures + '\\]\\[value\\]]').val();
            quantityOfOtherStructures++;
        }
        else
        {
            break;
        }
    }

    var sum = 0;

    sum = constructionEl*0.005 + isExteriorTrim*exteriorTrim*0.005 + isInteriorTrim*interiorTrim*0.005 + isEngineeringSystems*engineeringSystems*0.005 + isProperty*property*0.006 + isLiability*liability*0.01;
    sum += otherStructures[0].name*otherStructures[0].value*0.01 + otherStructures[1].name*otherStructures[1].value*0.01 + otherStructures[2].name*otherStructures[2].value*0.005 + otherStructures[3].name*otherStructures[3].value*0.01;
    for (var i=4; i<quantityOfOtherStructures; i++)
        sum += otherStructures[i].name*otherStructures[i].value*0.01;
    sum += isLandscape*landscape*0.01;

    $('[name=villaggioResult]').val(sum);

    $('[name = villaggio\\[isConstructionEl\\]]').change(function () {
        $('[name = villaggio\\[isConstructionEl\\]]').attr('checked', true);
        ConvertAllCheckbox();
    })
}

function villaggioUpdateSecondPage()
{
    if ($('#insurant\\[beneficiary\\]:checked').length)
    {
        $('#beneficiary\\[name\\]').val($('#insurant\\[name\\]').val());
        $('#beneficiarybirthday').val($('#insurantbirthday').val());
    }
    $('#insurant\\[beneficiary\\]').change(function (){
        if ($('#insurant\\[beneficiary\\]:checked').length == 0)
        {
            $('#beneficiary\\[name\\]').val('');
            $('#beneficiarybirthday').val('');
        }
    })
}

function feliceCittaUpdateFirstPage()
{
    var isConstructionEl = $('[name="feliceCitta\\[isConstructionEl\\]"]').is(':checked');
    var constructionEl = $('#feliceCitta\\[constructionEl\\]').val();
    var isInteriorTrim = $('[name="feliceCitta\\[isInteriorTrim\\]"]').is(':checked');
    var interiorTrim = $('#feliceCitta\\[interiorTrim\\]').val();
    var isEngineeringSystems = $('[name="feliceCitta\\[isEngineeringSystems\\]"]').is(':checked');
    var engineeringSystems = $('#feliceCitta\\[engineeringSystems\\]').val();
    var isProperty = $('[name="feliceCitta\\[isProperty\\]"]').is(':checked');
    var property = $('#feliceCitta\\[property\\]').val();
    var isLiability = $('[name="feliceCitta\\[isLiability\\]"]').is(':checked');
    var liability = $('#feliceCitta\\[liability\\]').val();
    var sum;

    sum = isConstructionEl*constructionEl*0.005 + isInteriorTrim*interiorTrim*0.005 + isEngineeringSystems*engineeringSystems*0.005 + isProperty*property*0.006 + isLiability*liability*0.01;

    $('[name=feliceCittaResult]').val(sum);
}

function bellaVitaUpdateFirstPage()
{
    var insuranceAmount = $('#bellaVita\\[insuranceAmount\\]').val();
    var sum = 0;

    sum = insuranceAmount*0.005;

    $('[name=bellaVitaResult]').val(sum);
}

function bellissimoUpdateFirstPage()
{
    //update Model List
    $('#bellissimo\\[typeOfCar\\]').change(function () {
        var typeOfCar = $('#bellissimo\\[typeOfCar\\]').val();
            if (typeOfCar > 0)
            {
                $.getJSON('../engine/ajax.php?get=getModels&type='+typeOfCar, function (data)
                    {
                        $('#bellissimo\\[modelOfCar\\]').empty();
                        var html = '<option value="0" disabled="disabled" selected = "selected">Выбрать...</option>';
                        for (var key in data)
                        {
                            html += '<option value="' + key + '">' + data[key] + '</option>';
                        }
                        $(html).appendTo('#bellissimo\\[modelOfCar\\]');
                    }
                )
            }
    })

    //check carAmount value
    if ($('#bellissimo\\[carAmount\\]').val() == "")
    {
        $('#bellissimo\\[carAmount\\]').val(500000);
    }

    //driver must be over 18 years old
    $('[id^="bellissimoDriversdriver"]').each (function (index, element) {
        var today = new Date();
        today.setYear(today.getYear()-18);
        if (new Date(parseInt(element.value.split('.')[2]), element.value.split('.')[1]-1, element.value.split('.')[0]).getTime() >= (today.getTime()))
        {
            alert ('Возраст водителя должен быть больше 18 лет');
            element.value = '';
        }

    })

}

function bellissimoUpdateSecondPage()
{
    $.getJSON('../engine/ajax.php?get=session', function (data) {
        var damage = data.cars[data.session.calc.bellissimo.typeOfCar][data.session.calc.bellissimo.modelOfCar][0].damage;
        var theft = data.cars[data.session.calc.bellissimo.typeOfCar][data.session.calc.bellissimo.modelOfCar][0].theft;
    })
}

function addDriver()
{
    var driversQuantity = $('[id^="bellissimoDriversdriver"]').length;
    if (driversQuantity < 5){

        var html = '<div class="grid_label">Дата рождения:</div>' +
                '<script type="text/javascript">' +
                '    $(function(){' +
                '        $(\'#bellissimoDriversdriver' + driversQuantity +'birthDay\').datepicker({' +
                '            inline: true,' +
                '            changeMonth: true,' +
                '            changeYear: true' +
                '        });' +
                '        $(\'#bellissimoDriversdriver' + driversQuantity +'birthDay\').datepicker( \"option\", \"dateFormat\", \"dd.mm.yy\" );' +
                '        $(\'#bellissimoDriversdriver' + driversQuantity +'birthDay\').datepicker( $.datepicker.regional[ \"ru\" ] );' +
                '        $(\'#dialog_link, ul#icons li\').hover(' +
                '            function() { $(this).addClass(\'ui-state-hover\'); },' +
                '            function() { $(this).removeClass(\'ui-state-hover\'); }' +
                '        );' +
                '    });' +
                '</script>' +
                '<div class="r1"><input type="text" name="bellissimoDrivers[driver][' + driversQuantity +'][birthDay]" value=""  class="text_input" id="bellissimoDriversdriver' + driversQuantity +'birthDay" onClick="this.value=\'\';"></div>' +
                '<div class="grid_label">Стаж вождения (полных лет):</div><div class="r1"><input class="text_input short" type="text" name="bellissimoDrivers[driver][' + driversQuantity +'][experience]" value="" placeholder="3"></div>';

        $(html).appendTo('#drivers');
        driversQuantity++;
    }

}

function removeDriver()
{
    var driversQuantity = $('[id^="bellissimoDriversdriver"]').length;
    $('#drivers:last-child').empty();
}

function addEquipment(img, id)
{
    img.setAttribute('src','/images/faticons/16x16/delete.png');
    img.setAttribute('onclick','removeEquipment('+ id +')');
    id++;
    var html = '<tr id="bellissimoAdditional[equipment][' + id + ']">'+
        '<td align="center"><input class="text_input short" type="text" id="bellissimoAdditional[equipment][' + id + '][name]" name="bellissimoAdditional[equipment][' + id + '][name]" value="" placeholder="Наименование" align="center"></td>'+
        '<td align="center"><input class="text_input short" type="text" id="bellissimoAdditional[equipment][' + id + '][cost]" name="bellissimoAdditional[equipment][' + id + '][cost]" value="" placeholder="Стоимость" align="center"></td>'+
        '<td><a href="#" name="addEquipment"><img src="/images/faticons/16x16/plus.png" onclick="addEquipment(this, ' + id + ')"></a></td>'+
      '</tr>';
    $(html).appendTo('#additionalEquipment');
}

function removeEquipment(id)
{
    $('#bellissimoAdditional\\[equipment\\]\\[' + id + '\\]').remove();
}


function feliceCittaValidateFirst()
{
    var isConstructionEl = $('[name="feliceCitta\\[isConstructionEl\\]"]').is(':checked');
    var constructionEl = $('#feliceCitta\\[constructionEl\\]').val();
    var isInteriorTrim = $('[name="feliceCitta\\[isInteriorTrim\\]"]').is(':checked');
    var interiorTrim = $('#feliceCitta\\[interiorTrim\\]').val();
    var isEngineeringSystems = $('[name="feliceCitta\\[isEngineeringSystems\\]"]').is(':checked');
    var engineeringSystems = $('#feliceCitta\\[engineeringSystems\\]').val();
    var isProperty = $('[name="feliceCitta\\[isProperty\\]"]').is(':checked');
    var property = $('#feliceCitta\\[property\\]').val();
    var isLiability = $('[name="feliceCitta\\[isLiability\\]"]').is(':checked');
    var liability = $('#feliceCitta\\[liability\\]').val();

    var valid = false;

    if (isInteriorTrim == true || isLiability == true)
    {
        valid = true;
    }
    else
    {
        alert ('Необходимо застраховать внутреннюю отделку или гражданскую ответственность');
    }


    if (isProperty || isEngineeringSystems)
    {
        if ((isConstructionEl && isLiability) || isInteriorTrim)
            valid = true;
        else
            alert('Если Вы выбрали риски "имущество" и/или "инженерные системы", то необходимо выбрать "конструктивные элементы" и/или "внутрення отделка"');
    }

    return valid;
}

