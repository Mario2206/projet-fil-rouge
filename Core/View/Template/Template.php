<?php 

namespace Core\View\Template;

class Template implements ITemplate {

    private $_title = "Template";

    private $_scriptNames = [];

    private $_stylesNames = [];

    private $_templateViewName = "templateView";

    private $_contextVars = [];


    public function __construct(string $pageTitle, array $scriptsNames = [], array $stylesNames = [])
    {
        
        $this->_title = $pageTitle;
        $this->_scriptNames = $scriptsNames;
        $this->_stylesNames = $stylesNames;
    }

    /**
     * For rendering the view
     * 
     * @param string $content 
     */
    public function render (string $content) : void{
        extract($this->_contextVars);
        $templateTitle = $this->_title;
        $templateScripts = $this->_scriptNames;
        $templateStyles = $this->_stylesNames;
     
        require(ROOT . "/App/View/inc/" . $this->_templateViewName . ".php");
    }

    /**
     * For setting template file name
     * 
     * @param string $templateFileName
     * 
     * @return self
     */
    public function setTemplateView (string $templateFileName) : self {
        $this->_templateViewName = $templateFileName;
        return $this;
    }

    /**
     * For setting context vars 
     * 
     * @param array $contextVars (["var name" => "value"])
     * 
     * @return self
     */
    public function setContextVars (array $contextVars) : self {
        $this->_contextVars = $contextVars;
        return $this;
    }


}