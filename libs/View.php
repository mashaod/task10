<?php

class View
{
    private $file;

    public function __construct($template)
    {       
        $this->file = file_get_contents($template);
    }

    public function createTemplate($data)
    {
        foreach($data as $key=>$val)
        {
            $str .= "<tr><td style=\"width:20%\">" . $key . "</td><td>" . $val . "</td></tr>";
        } 
                                                          
        $this->file = str_replace('%TABLE%', $str, $this->file);
        echo $this->file;
    }    
}
