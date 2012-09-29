// JavaScript Document ------------------------------------------------------------------------------------------------
function counter_up(id, step)
{
	document.getElementById(id).value = parseInt(document.getElementById(id).value) + step;	
}

function counter_down(id, step)
{
	if(parseInt(document.getElementById(id).value) >= step)
	{
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