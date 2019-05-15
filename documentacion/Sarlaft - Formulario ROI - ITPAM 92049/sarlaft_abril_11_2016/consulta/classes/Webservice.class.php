<?php

/**
 *
 * Esta clase sirve para establece conexiones cliente servidor con un webservice y además crear webservices básicos
 * a partir de una sentencia sql
 *
 * @author UNE TELECOMUNICACIONS T&O
 *
 */
require('WSS_SoapClient.php');

class Webservice {

    public $cliente     = '';
    public $server      = '';
    public $errores     = '';
    public $cache       = '0';
    public $cache_ttl   = '43200';
    public $key_file    = '';    
    public $passphrase  = '';    
    public $cert_file   = ''; 
    public $exception;


    private static $objInstancia = null;

    /**
     * Metódo singleton por medio del cual se instancia de manera única el objeto de ésta clase
     */
    public static function singleton() {
        if (self::$objInstancia == null)
            self::$objInstancia = new self ();

        return self::$objInstancia;
    }

    /**
     * Este método estable una conexión con un cliente webservices pasando la url como parametro
     *
     * @author UNE TELECOMUNICACIONS T&O
     *        
     * @param string $url        	
     */
    function conectarCliente($url, $options = array(),$setLocation=null) {
        ini_set('soap.wsdl_cache_enabled', $this->cache);
        ini_set('soap.wsdl_cache_ttl', $this->cache_ttl);
        if ($url != '') {
            try { 
                
                if(!empty($this->key_file) && !empty($this->cert_file))
                {
                    $this->cliente                 = new WSS_SoapClient($url, $options);                
                    $this->cliente->key_file       = $this->key_file;
                    $this->cliente->passphrase     = $this->passphrase;
                    $this->cliente->cert_file      = $this->cert_file;
                }
                else{
                    $this->cliente                 = new SoapClient($url, $options);    
                }
                if(!empty($setLocation) && $setLocation !=null){
                    $this->cliente->__setLocation($setLocation);
                }
                
            } catch (Exception $ex) {
                $this->exception = $ex;
            }
               catch (SoapFault $e) {
                $this->exception = $e;
            }
        }
    }

    /**
     * Este método estable una conexión con un servidor webservices pasando la url como parametro
     *
     * @author UNE TELECOMUNICACIONS T&O
     *        
     * @param string $url        	
     */
    function conectarServer($url, $options = array()) {
        ini_set('soap.wsdl_cache_enabled', $this->cache);
        ini_set('soap.wsdl_cache_ttl', $this->cache);
        if ($url != '') {
            try {
                $this->server = new SoapServer($url, $options); // en esta línea se especifica la ruta y nombre del WSDL
            } catch (SoapFault $e) {
                return $e->getMessage();
            }
        }
    }

}
?>
