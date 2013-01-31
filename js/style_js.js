// JavaScript Document ------------------------------------------------------------------------------------------------
function counter_up(id, step)
{
    if (!document.getElementById(id).readOnly)
    {
        if (document.getElementById(id).value == "")
            document.getElementById(id).value = 300000;
        document.getElementById(id).value = parseInt(document.getElementById(id).value) + step;
    }

}

function counter_down(id, step)
{
    if (!document.getElementById(id).readOnly)
    {
        if (document.getElementById(id).value == "")
            document.getElementById(id).value = 300000;
        if(parseInt(document.getElementById(id).value) >= step)
            document.getElementById(id).value = parseInt(document.getElementById(id).value) - step;
    }

}

// JavaScript Document ------------------------------------------------------------------------------------------------

// Установка стилей в соответствии с текущим состоянием чекбоксов на странице
function ConvertAllCheckbox()
{
	var el=document.getElementsByTagName('input');
	for (var i=0; i<el.length; i++) {
		if (el[i].type.toLowerCase()=='checkbox') {
			doCheckbox(el[i]);
		}
	}
}

// Обработка состояния чекбокса
function doCheckbox(elem) {
	// Чекбокс должен быть внутри DIV'а и иметь стиль 'boxCheckbox'
	if (elem.className=='boxCheckbox' &&
		elem.parentNode.tagName.toLowerCase()=='div') {
		// Поменять стиль "обертки" в зависимости от состояния переключателя
		elem.parentNode.className='box'+(elem.checked?'Checked':'Unchecked');
	}
}

// JavaScript Document 22222222 ----------------------------------------------------------------------------------------

// Установка стилей в соответствии с текущим состоянием на странице
function ConvertAllRadio()
{
	var el=document.getElementsByTagName('input');
	for (var i=0; i<el.length; i++) {
		if (el[i].type.toLowerCase()=='radio') {
			doRadio(el[i]);
		}
	}
}

// Обработка состояния
function doRadio(elem) {
	if (elem.className=='boxRadio' &&
		elem.parentNode.tagName.toLowerCase()=='div') {
		// Поменять стиль "обертки" в зависимости от состояния переключателя
		elem.parentNode.className='boxRadio'+(elem.checked?'Checked':'Unchecked');
	}
}

function doSliderCheckbox(elem, sliderId) {
	// Чекбокс должен быть внутри DIV'а и иметь стиль 'boxCheckbox'
	if (elem.className=='boxCheckbox' &&
		elem.parentNode.tagName.toLowerCase()=='div') {
		// Поменять стиль "обертки" в зависимости от состояния переключателя
		elem.parentNode.className='box'+(elem.checked?'Checked':'Unchecked');
	}

    if (elem.checked){
        document.getElementById(sliderId).removeAttribute('readonly');
    }
    else {
        document.getElementById(sliderId).setAttribute('readonly', 'readonly');
    }
}

function addNewAdditionalStructure() {
    $("#addNewAdditionalStructure").dialog('open');
}

function login() {
    $("#login").dialog('open');
}



/*function addNewDriver() {
    $("#addNewDriver").dialog('open');
}*/

function selectCarMarkList(){
    $("#selectCarMark").dialog('open');
}

function selectCarMark(id, carMark){
    document.getElementById('typeOfCarId').value = id;
    document.getElementById('typeOfCarName').value = carMark;
    document.getElementById('typeOfModelId').value = '';
    document.getElementById('typeOfModelName').value = '';
    document.getElementById('modificationOfCarId').value = '';
    document.getElementById('modificationOfCarName').value = '';
    document.getElementById('bellissimo[carAmount]').value = '';
    $("#selectCarMark").dialog('close');
}

function selectCarModelList() {
    var typeOfCar = $('#typeOfCarId').val();
    if (typeOfCar > 0)
    {
        $.get('../engine/ajax.php?get=getModels&type='+typeOfCar, function (data)
        {
            $('#typeOfModelId').empty();
            $('#typeOfModelName').empty();
            $('#selectCarModel').empty();
            $(data).appendTo('#selectCarModel');
        });
        $("#selectCarModel").dialog('open');
    }
}

function selectCarModel(id, carModel){
    document.getElementById('typeOfModelId').value = id;
    document.getElementById('typeOfModelName').value = carModel;
    document.getElementById('modificationOfCarId').value = '';
    document.getElementById('modificationOfCarName').value = '';
    document.getElementById('bellissimo[carAmount]').value = '';
    $("#selectCarModel").dialog('close');
}

function selectYearList() {
    $("#selectStartYear").dialog('open');
}

function selectStartYear(yearId, yearName){
    document.getElementById('yearId').value = yearId;
    document.getElementById('yearName').value = yearName;
    $("#selectStartYear").dialog('close');
}


function selectCarModificationList() {
    var ModelOfCar = $('#typeOfModelId').val();
    var year = $('#bellissimo\\[yearOfCar\\]').val();
    if (ModelOfCar > 0 && year > 0)
    {
        var selectedYear = new Date();
        if (year == 1)
        {
            selectedYear = selectedYear.getFullYear();
        }
        else
        {
            selectedYear = selectedYear.getFullYear();
            selectedYear = selectedYear - parseInt(year) + 2;
        }
        $.get('../engine/ajax.php?get=getModifications&model='+ ModelOfCar +'&year='+selectedYear, function (data)
        {
            $('#modificationOfCarId').empty();
            $('#modificationOfCarName').empty();
            $('#selectCarModification').empty();
            $(data).appendTo('#selectCarModification');
        });
        $("#selectCarModification").dialog('open');
    }
}

function selectCarModification(id, carModification, cost){
    document.getElementById('modificationOfCarId').value = id;
    document.getElementById('modificationOfCarName').value = carModification;
    document.getElementById('bellissimo[carAmount]').value = cost;
    $("#selectCarModification").dialog('close');
}
