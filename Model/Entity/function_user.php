<?php

class function_user {
    public $functionID;
    public $functionName;

    public function __construct($functionID, $functionName) {
        $this->functionID = $functionID;
        $this->functionName = $functionName;
    }

    // Getter và setter cho functionID
    public function getFunctionID() {
        return $this->functionID;
    }

    public function setFunctionID($functionID) {
        $this->functionID = $functionID;
    }

    // Getter và setter cho functionName
    public function getFunctionName() {
        return $this->functionName;
    }

    public function setFunctionName($functionName) {
        $this->functionName = $functionName;
    }
}

?>
