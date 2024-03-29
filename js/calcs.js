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

    //driver must be over 18 years old
    for (var i=0; i<3; i++)
    {
        if (document.getElementById('bellissimoDrivers[driver][' + i + '][birthDay]'))
        {
            if (document.getElementById('bellissimoDrivers[driver][' + i + '][birthDay]').value < 18)
            {
                document.getElementById('bellissimoDrivers[driver][' + i + '][birthDay]').value = 18;
            }
            if (parseInt(document.getElementById('bellissimoDrivers[driver][' + i + '][experience]').value) + 18 > parseInt(document.getElementById('bellissimoDrivers[driver][' + i + '][birthDay]').value))
            {
                document.getElementById('bellissimoDrivers[driver][' + i + '][experience]').value = document.getElementById('bellissimoDrivers[driver][' + i + '][birthDay]').value - 18;
            }
        }


    }

    $('[id^="bellissimoDrivers"]').each (function (index, element) {
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
    var driversQuantity = $('[id^="bellissimoDrivers"]').length;
    if (driversQuantity < 6){

        var html = '<div class="grid_label">Полных лет:</div><div class="r1"><input class="text_input" type="number" id="bellissimoDrivers[driver][' + driversQuantity/2 +'][birthDay]" name="bellissimoDrivers[driver][' + driversQuantity/2 +'][birthDay]" value="" placeholder="Полных лет"></div>' +
                    '<div class="grid_label">Стаж вождения (полных лет):</div><div class="r1"><input class="text_input short" type="number" id="bellissimoDrivers[driver][' + driversQuantity/2 +'][experience]" name="bellissimoDrivers[driver][' + driversQuantity/2 +'][experience]" value="" placeholder="Стаж"></div>';

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

