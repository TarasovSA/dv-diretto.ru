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
    //sum += isLandscape*landscape*0.01;

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

    sum = Math.ceil(isConstructionEl*constructionEl*0.005 + isInteriorTrim*interiorTrim*0.005 + isEngineeringSystems*engineeringSystems*0.005 + isProperty*property*0.006 + isLiability*liability*0.01);

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
    document.getElementById('bellissimoOthers[antiStealing][0]').setAttribute('checked', 'checked');
    if (document.getElementById('bellissimoOthers[antiStealing][0]').className=='boxCheckbox' &&
        document.getElementById('bellissimoOthers[antiStealing][0]').parentNode.tagName.toLowerCase()=='div') {
        // Поменять стиль "обертки" в зависимости от состояния переключателя
        document.getElementById('bellissimoOthers[antiStealing][0]').parentNode.className='boxChecked';
    }
    //update Model List
    $('#typeOfCarId').change(function () {
        var typeOfCar = $('#typeOfCarId').val();
        if (typeOfCar > 0)
        {
            $.get('../engine/ajax.php?get=getModels&type='+typeOfCar, function (data)
            {
                $('#typeOfModelId').empty();
                $('#typeOfModelName').empty();
                $(data).appendTo('#selectCarModel');
            })
        }
    })

    //check carAmount value
    /*if ($('#bellissimo\\[carAmount\\]').val() == "")
    {
        $('#bellissimo\\[carAmount\\]').val(500000);
    }*/

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

function bellissimoUpdateSecondPage(k1, k7)
{
    //set ReadOnly
    document.getElementById('bellissimo[kasko]').setAttribute('readonly','readonly');
    document.getElementById('amount[kasko]').setAttribute('readonly','readonly');
    document.getElementById('amount[VIPPackAmount]').setAttribute('readonly','readonly');
    document.getElementById('amount[liability]').setAttribute('readonly','readonly');
    document.getElementById('amount[accident]').setAttribute('readonly','readonly');
    document.getElementById('amount[EquipmentAmount]').setAttribute('readonly','readonly');
    document.getElementById('amount[amountSummary]').setAttribute('readonly','readonly');

    //calc
    document.getElementById('amount[kasko]').value = document.getElementById('bellissimo[kasko]').value + '.00';

    var Tdo = 7.9 * k1 * k7;
    var Tgo = 0.099 * k7;
    var Tns = 0.24 * k7;
    var summaryTdo = 0;

    $('[name^="bellissimoAdditional\\[equipment\\]"]').each (function (index, element) {
        if (index%2 == 1)
        {
            summaryTdo += element.value * Tdo;
        }
    });

    var isConstructionEl = $('[name="feliceCitta\\[isConstructionEl\\]"]').is(':checked');
    var vipSumm = 0;
    if (document.getElementById('bellissimoMaintenance[information][0]').checked)
        vipSumm += 1500;
    if (document.getElementById('bellissimoMaintenance[information][1]').checked)
        vipSumm += 1000;
    if (document.getElementById('bellissimoMaintenance[information][2]').checked)
        vipSumm += 2000;

    if (document.getElementById('carAmount').value > 750000)
    {
        document.getElementById('bellissimoMaintenance[information][0]').setAttribute('checked','checked');
        document.getElementById('bellissimoMaintenance[information][1]').setAttribute('checked','checked');
        document.getElementById('bellissimoMaintenance[information][2]').setAttribute('checked','checked');
        if (document.getElementById('bellissimoMaintenance[information][0]').className=='boxCheckbox' &&
            document.getElementById('bellissimoMaintenance[information][0]').parentNode.tagName.toLowerCase()=='div') {
            // Поменять стиль "обертки" в зависимости от состояния переключателя
            document.getElementById('bellissimoMaintenance[information][0]').parentNode.className='boxChecked';
        }
        if (document.getElementById('bellissimoMaintenance[information][1]').className=='boxCheckbox' &&
            document.getElementById('bellissimoMaintenance[information][1]').parentNode.tagName.toLowerCase()=='div') {
            // Поменять стиль "обертки" в зависимости от состояния переключателя
            document.getElementById('bellissimoMaintenance[information][1]').parentNode.className='boxChecked';
        }
        if (document.getElementById('bellissimoMaintenance[information][2]').className=='boxCheckbox' &&
            document.getElementById('bellissimoMaintenance[information][2]').parentNode.tagName.toLowerCase()=='div') {
            // Поменять стиль "обертки" в зависимости от состояния переключателя
            document.getElementById('bellissimoMaintenance[information][2]').parentNode.className='boxChecked';
        }
        vipSumm = 0;
    }


    summaryTgo = document.getElementById('bellissimoAdditional[liability]').value * Tgo;
    summaryTns = document.getElementById('bellissimoAdditional[accident]').value * Tns;

    document.getElementById('bellissimoAdditional[EquipmentAmount]').value = Math.ceil(summaryTdo/100);
    document.getElementById('bellissimoMaintenance[VIPPackAmount]').value = Math.ceil(vipSumm);

    document.getElementById('amount[EquipmentAmount]').value = Math.ceil(summaryTdo/100) + '.00';
    document.getElementById('amount[VIPPackAmount]').value = Math.ceil(vipSumm) + '.00';

    document.getElementById('amount[liability]').value = Math.ceil(summaryTgo/100) + '.00';
    document.getElementById('amount[accident]').value = Math.ceil(summaryTns/100) + '.00';

    document.getElementById('amount[amountSummary]').value = Math.ceil(parseInt(document.getElementById('bellissimo[kasko]').value) + parseInt(Math.ceil(summaryTdo/100)) + parseInt(Math.ceil(vipSumm)) + parseInt(Math.ceil(summaryTgo/100)) + parseInt(Math.ceil(summaryTns/100))) + '.00';


    //set Read Only if isTransition false
    if (document.getElementById('bellissimoDiscount[isTransition]').checked)
    {
        document.getElementById('bellissimoDiscount[transition]').removeAttribute('readonly');
        document.getElementById('bellissimoDiscount[polis]').removeAttribute('readonly');
    }
    else
    {
        document.getElementById('bellissimoDiscount[transition]').setAttribute('readonly','readonly');
        document.getElementById('bellissimoDiscount[polis]').setAttribute('readonly','readonly');
    }

    if (document.getElementById('bellissimoDiscount[isFranchise]').checked)
    {
        document.getElementById('bellissimo[Franchise]').removeAttribute('disabled');
    }
    else
    {
        document.getElementById('bellissimo[Franchise]').setAttribute('disabled','disabled');
    }
}

function bellissimoUpdateThirdPage()
{
    document.getElementById('bellissimoAutoInfo[typeOfCar]').setAttribute('readonly','readonly');
    document.getElementById('bellissimoAutoInfo[modelOfCar]').setAttribute('readonly','readonly');
    document.getElementById('bellissimoAutoInfo[yearOfCar]').setAttribute('readonly','readonly');

    if (document.getElementById('bellissimoBeneficiary[isInsurant]').checked)
    {
        document.getElementById('bellissimoBeneficiary[beneficiary][name]').value = document.getElementById('insurant[name]').value;
        document.getElementById('bellissimoBeneficiary[beneficiary][region]').value = document.getElementById('insurant[region]').value;
        document.getElementById('bellissimoBeneficiary[beneficiary][city]').value = document.getElementById('insurant[city]').value;
        document.getElementById('bellissimoBeneficiary[beneficiary][street]').value = document.getElementById('insurant[street]').value;
        document.getElementById('bellissimoBeneficiary[beneficiary][house]').value = document.getElementById('insurant[house]').value;
        document.getElementById('bellissimoBeneficiary[beneficiary][housing]').value = document.getElementById('insurant[housing]').value;
        document.getElementById('bellissimoBeneficiary[beneficiary][apartment]').value = document.getElementById('insurant[apartment]').value;
        document.getElementById('bellissimoBeneficiary[beneficiary][passportSeries]').value = document.getElementById('insurant[passportSeries]').value;
        document.getElementById('bellissimoBeneficiary[beneficiary][passportNumber]').value = document.getElementById('insurant[passportNumber]').value;
        document.getElementById('bellissimoBeneficiarybeneficiarybirthday').value = document.getElementById('insurantbirthday').value;
        document.getElementById('bellissimoBeneficiary[beneficiary][phone]').value = document.getElementById('insurant[phone]').value;
    }
    else
    {
        document.getElementById('bellissimoBeneficiary[beneficiary][name]').value = '';
        document.getElementById('bellissimoBeneficiary[beneficiary][region]').value = '';
        document.getElementById('bellissimoBeneficiary[beneficiary][city]').value = '';
        document.getElementById('bellissimoBeneficiary[beneficiary][street]').value = '';
        document.getElementById('bellissimoBeneficiary[beneficiary][house]').value = '';
        document.getElementById('bellissimoBeneficiary[beneficiary][housing]').value = '';
        document.getElementById('bellissimoBeneficiary[beneficiary][apartment]').value = '';
        document.getElementById('bellissimoBeneficiary[beneficiary][passportSeries]').value = '';
        document.getElementById('bellissimoBeneficiary[beneficiary][passportNumber]').value = '';
        document.getElementById('bellissimoBeneficiarybeneficiarybirthday').value = '';
        document.getElementById('bellissimoBeneficiary[beneficiary][phone]').value = '';
    }

    if (document.getElementById('bellissimoBeneficiary[isAutoInBank]').checked)
    {
        document.getElementById('autoInBank').removeAttribute('style','display:none');
    }
    else
    {
        document.getElementById('autoInBank').setAttribute('style','display:none');
    }

    if (document.getElementById('bellissimoAutoInfo[isRegistred]').checked)
    {
        document.getElementById('bellissimoAutoInfo[vehicleCertificate]').setAttribute('readonly');
        document.getElementById('bellissimoAutoInfo[stateNumber]').setAttribute('readonly');
    }
    else
    {
        document.getElementById('bellissimoAutoInfo[vehicleCertificate]').removeAttribute('readonly');
        document.getElementById('bellissimoAutoInfo[stateNumber]').removeAttribute('readonly');
    }

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
                '            changeYear: true,' +
                '            maxDate: -6575' +
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
                '<div class="grid_label">Стаж вождения (полных лет):</div><div class="r1"><input class="text_input short" type="text" name="bellissimoDrivers[driver][' + driversQuantity +'][experience]" value="" placeholder="Стаж"></div>';

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
        '<td align="center"><input class="text_input short" type="text" id="bellissimoAdditional[equipment][' + id + '][name]" name="bellissimoAdditional[equipment][' + id + '][name]" value="" placeholder="Наименование" align="center" style="border:none; -webkit-border-radius: 0px; -moz-border-radius: 0px; border-radius: 0px; width:325px;"></td>'+
        '<td align="center"><input class="text_input short" type="text" id="bellissimoAdditional[equipment][' + id + '][cost]" name="bellissimoAdditional[equipment][' + id + '][cost]" value="" placeholder="Стоимость" align="center" style="border:none; -webkit-border-radius: 0px; -moz-border-radius: 0px; border-radius: 0px; width:165px;"></td>'+
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

