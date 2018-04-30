<?php

class CFPP_Notifications {

    protected $warnings;
    protected $notices;
    protected $errors;

    public function __construct() {
        $this->warnings = [];
        $this->notices = [];
        $this->errors = [];
    }

    /**
    *   Adiciona uma mensagem de Warning na pilha
    */
    public function add_warning($message) {
        $this->warnings[] = $message;
    }

    /**
    *   Adiciona uma mensagem de Erro na pilha
    */
    public function add_error($message) {
        $this->errors[] = $message;
    }

    /**
    *   Adiciona uma mensagem de Notice na pilha
    */
    public function add_notice($message) {
        $this->notices[] = $message;
    }

    /**
    *   Retorna os warnings public ou admin
    */
    public function get_warnings() {
        return $this->warnings;
    }

    /**
    *   Retorna os erros public ou admin
    */
    public function get_errors() {
        return $this->errors;
    }

    /**
    *   Retorna os notices public ou admin
    */
    public function get_notices() {
        return $this->notices;
    }

}
