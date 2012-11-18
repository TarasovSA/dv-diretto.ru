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

function selectCarMarkList(){
    $("#selectCarMark").dialog('open');
}

function addNewDriver() {
    $("#addNewDriver").dialog('open');
}

function selectCarMark(id, carMark){
    document.getElementById('typeOfCarId').value = id;
    document.getElementById('typeOfCarName').value = carMark;
    $("#selectCarMark").dialog('close');
}

function selectCarModelList() {
    $("#selectCarModel").dialog('open');
}
