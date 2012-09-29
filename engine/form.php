<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Lamer
 * Date: 17.07.12
 * Time: 17:56
 * To change this template use File | Settings | File Templates.
 */
class form
{
    private $action;
    private $method;
    private $currentBlock;
    private $inputs = array();

    public function __construct()
    {
        $this->currentBlock = 0;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function setAction ($action)
    {
        $this->action = $action;
    }

    public function addInput($input)
    {
        $this->inputs[$this->currentBlock]['inputs'][] = $input;
    }
    public function setNameCurrentBlock ($name)
    {
        $this->inputs[$this->currentBlock]['blockName'] = $name;
    }
    public function putNewBlock ($name, $class)
    {
        $this->currentBlock++;
        $this->inputs[$this->currentBlock]['blockName'] = $name;
        $this->inputs[$this->currentBlock]['class'] = $class;
        $this->inputs[$this->currentBlock]['inputs'] = array();
    }
    public function printForm()
    {
        echo "<form action=\"$this->action\" method=\"$this->method\">";
        foreach ($this->inputs as $block)
        {
            echo "<div class=\"".$block['class']."\"><div class=\"grid_title\">".$block['blockName']."</div>";
            foreach ($block['inputs'] as $input)
            {
                $input->show();
            }
            echo '<div style="clear:both;"></div></div>';
        }
        echo "</form>";
    }

}
class input
{
    private $name;
    private $type;
    private $value;
    private $pre;
    private $class;
    private $divWidth;

    public function __construct($name, $type, $pre, $value, $class = '', $divWidth = '3')
    {
        $this->name = $name;
        $this->type = $type;
        $this->pre = $pre;
        $this->value = $value;
        $this->class = $class;
        $this->divWidth = $divWidth;
    }
    public function update ($name, $type, $pre, $value, $class = '', $divWidth = '3')
    {
        $this->name = $name;
        $this->type = $type;
        $this->pre = $pre;
        $this->value = $value;
        $this->class = $class;
        $this->divWidth = $divWidth;
    }
    public function show()
    {
        switch ($this->type)
        {
            case 'slider':
                echo $this->pre==null?'':"<div class=\"grid_label\">$this->pre</div>";
                echo "<div class=\"r$this->divWidth\"><img src=\"/images/left_arrow.png\" class=\"arrows_button\" align=\"absbottom\" onclick=\"counter_down('$this->name',200);\"  alt=\"left\"/><input name=\"$this->name\" class=\"arrow_input\" type=\"text\" id=\"$this->name\" value=\"$this->value\"/><img src=\"/images/right_arrow.png\" class=\"arrows_button\" align=\"absbottom\" onclick=\"counter_up('$this->name',200);\"  alt=\"right\"/></div>";
                break;
            case 'isSlider':
                {
                if ($this->value == 1)
                    echo "<div class=\"grid_label\"><div><input class=\"boxCheckbox\" onclick=\"doCheckbox(this);\" name=\"is$this->name\" type=\"checkbox\" value=\"1\" checked=\"checked\"/> $this->pre</div></div>";
                else
                    echo "<div class=\"grid_label\"><div><input class=\"boxCheckbox\" onclick=\"doCheckbox(this);\" name=\"is$this->name\" type=\"checkbox\" value=\"1\"/> $this->pre</div></div>";
                echo "<div class=\"r$this->divWidth\"><img src=\"/images/left_arrow.png\" class=\"arrows_button\" align=\"absbottom\" onclick=\"counter_down('$this->name',200);\"  alt=\"left\"/><input name=\"$this->name\" class=\"arrow_input\" type=\"text\" id=\"$this->name\" value=\"$this->value\"/><img src=\"/images/right_arrow.png\" class=\"arrows_button\" align=\"absbottom\" onclick=\"counter_up('$this->name',200);\"  alt=\"right\"/></div>";
                break;
                }
            case 'checkbox':
                {
                if ($this->value == 1)
                    echo "<div class=\"r$this->divWidth\"><div><input class=\"$this->class\" onclick=\"doCheckbox(this);\" name=\"$this->name\" type=\"$this->type\" value=\"1\" checked=\"checked\"/> $this->pre</div></div>";
                else
                    echo "<div class=\"r$this->divWidth\"><div><input class=\"$this->class\" onclick=\"doCheckbox(this);\" name=\"$this->name\" type=\"$this->type\" value=\"1\"/> $this->pre</div></div>";
                break;
                }
			case 'isCheckbox':
                {
                if ($this->value == 1)
                    echo "<div class=\"grid_label\">$this->pre</div><div><div class=\"r$this->divWidth\"><div><input class=\"$this->class\" onclick=\"doCheckbox(this);\" name=\"$this->name\" type=\"checkbox\" value=\"1\" checked=\"checked\"/> $this->value</div></div>";
                else
                    echo "<div class=\"grid_label\">$this->pre</div><div class=\"r$this->divWidth\"><div><input class=\"$this->class\" onclick=\"doCheckbox(this);\" name=\"$this->name\" type=\"checkbox\" value=\"1\"/> $this->value</div></div>";
                break;
                }
            case 'radio':
                echo "<div class=\"r$this->divWidth\"><div><input class=\"$this->class\" onclick=\"doRadio(this);ConvertAllRadio();\" name=\"$this->name\" type=\"$this->type\" value=\"1\" checked=\"checked\"/>$this->pre</div></div>";
                break;
            case 'newLine':
                echo "<div style=\"clear:both;\"></div>";
                break;
            case 'dataPicker':
                echo $this->pre==null?'':"<div class=\"grid_label\">$this->pre</div>";
                echo "<script type=\"text/javascript\">
                            $(function(){

                                // Datepicker
                                $('#".str_replace(array("[", "]"),'',$this->name)."').datepicker({
                                    inline: true,
                                    changeMonth: true,
                                    changeYear: true
                                });

                                $( \"".str_replace(array("[", "]"),'',$this->name)."\" ).datepicker( \"option\", \"dateFormat\", \"dd.mm.yy\" );

                                $( \"".str_replace(array("[", "]"),'',$this->name)."\" ).datepicker( $.datepicker.regional[ \"ru\" ] );
                                //hover states on the static widgets
                                $('#dialog_link, ul#icons li').hover(
                                    function() { $(this).addClass('ui-state-hover'); },
                                    function() { $(this).removeClass('ui-state-hover'); }
                                );

                        });
                        </script>";
                echo "<div class=\"r$this->divWidth\"><input type=\"text\" name=\"$this->name\" value=\"$this->value\"  class=\"$this->class\" id=\"".str_replace(array("[", "]"),'',$this->name)."\" onClick=\"this.value='';\"></div>";
                break;
            case 'select':
                {
                echo $this->pre==null?'':"<div class=\"grid_label\">$this->pre</div>";
                echo "<div class=\"r$this->divWidth\"><div class=\"select\">
                            <select name=\"$this->name\" class=\"$this->class\">";
                echo "<option value=\"0\" disabled=\"disabled\">123123</option>";
                echo "<option value=\"0\" selected>123123</option>";
                echo "<option value=\"0\">123123</option>";


                foreach ($this->value as $id=>$value)
                {
                    if ($id == 0)
                        echo "<option value=\"0\" disabled=\"disabled\">$value</option>";
                    else
                        echo "<option value=\"$value\">$value</option>";
                }
                echo "</select></div></div>";
                break;
                }
            case 'custom':
                echo $this->pre==null?'':"<div class=\"grid_label\">$this->pre</div>";
                echo "<div class=\"r$this->divWidth\">$this->value</div>";
                break;
            default:
                echo $this->pre==null?'':"<div class=\"grid_label\">$this->pre</div>";
                echo "<div class=\"r$this->divWidth\"><input class=\"$this->class\" type=\"$this->type\" name=\"$this->name\" value=\"$this->value\"></div>";
        }



    }
}
