<?php

/**
 * class RijndaelHex
 */

/**
 * Encripta cadenas usando el método MCRYPT_RIJNDAEL_256
 *
 * @author Alvaro José Agámez Licha <ajagamez@cognox.com>
 * @version 1.3
 * @copyright 2012 UNE EPM Telecomunicaciones S.A.     
 * @category  Switch
 * @package   WebService 
 * @subpackage   Library 
 */
class RijndaelHex
{

    /**
     * Llave por defecto para encriptar
     * @var string
     */
    var $mykey = "anyword";

    /**
     * Constante para encriptar
     * @var string
     */
    var $myconst = "@l@7@f@j@";

    /**
     * Constructor de clase.
     * @author  José Joaquín Bermúdez Correa <jjbermudez@cognox.com>
     * @version SVN:$Id: RijndaelHex.php 2249 2012-10-10 17:25:28Z jjbermudez@COGNOX $
     * @copyright 2012 UNE EPM Telecomunicaciones S.A.                
     * @param char clave Clave que ser empleada como llave. 
     * Por defecto se emplea la palabra "anyworld".
     * @return RijndaelHex
     * @access public
     */
    public function __construct($clave = false)
    {
        if (!$clave) {
            $this->mykey = "anyword";
        } else {
            $this->mykey = $clave;
        }
        while (strlen($this->mykey) < 24) {
            $this->mykey.=chr(0);
        }
    }

    /**
     * Encripta un texto segun la llave.
     * @author  José Joaquín Bermúdez Correa <jjbermudez@cognox.com>
     * @version SVN:$Id: RijndaelHex.php 2249 2012-10-10 17:25:28Z jjbermudez@COGNOX $
     * @copyright 2012 UNE EPM Telecomunicaciones S.A.     
     * @param char text Texto que sera encriptado.
     * @return char
     * @access public
     */
    public function linencrypt($text)
    {
        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB); 
        //get vector size on ECB mode
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND); //Creating the vector
        $cryptedpass = mcrypt_encrypt(
            MCRYPT_RIJNDAEL_256, 
            $this->mykey, 
            $text, 
            MCRYPT_MODE_ECB, 
            $iv
        ); //Encrypting using MCRYPT_RIJNDAEL_128 algorithm
        return $cryptedpass;
    }

    /**
     * Encripta un texto según la llave. El resultado se entrega 
     * en forma hexadecimal (0a1fe7...).
     * @author  José Joaquín Bermúdez Correa <jjbermudez@cognox.com>
     * @version SVN:$Id: RijndaelHex.php 2249 2012-10-10 17:25:28Z jjbermudez@COGNOX $
     * @copyright 2012 UNE EPM Telecomunicaciones S.A.     
     * @param char text Texto que sera encriptado.
     * @return char
     * @access public
     */
    public function linencrypthex($text)
    {
        $cryptedpass = $this->linencrypt($text);
        $textHex = "";
        for ($i = 0; $i < strlen($cryptedpass); $i++) {
            $char = dechex(ord($cryptedpass[$i]));
            if (strlen($char) == 1)
                $textHex.="0";
            $textHex.=$char;
        }
        return $textHex;
    }

    /**
     * Desencripta un texto según la llave.
     * @author  José Joaquín Bermúdez Correa <jjbermudez@cognox.com>
     * @version SVN:$Id: RijndaelHex.php 2249 2012-10-10 17:25:28Z jjbermudez@COGNOX $
     * @copyright 2012 UNE EPM Telecomunicaciones S.A.     
     * @param char text Texto que sera desencriptado.
     * @return char
     * @access public
     */
    public function lindecrypt($enpass)
    {
        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);
        $decryptedpass = mcrypt_decrypt(
            MCRYPT_RIJNDAEL_256, 
            $this->mykey, $enpass, 
            MCRYPT_MODE_ECB, 
            $iv
        ); //Decrypting...
        return rtrim($decryptedpass);
    }

    /**
     * Desencripta un texto según la llave. 
     * El texto debe ser una cadena con los datos 
     * en forma hexadecimal (0a1fe7...).
     * @author  José Joaquín Bermúdez Correa <jjbermudez@cognox.com>
     * @version SVN:$Id: RijndaelHex.php 2249 2012-10-10 17:25:28Z jjbermudez@COGNOX $
     * @copyright 2012 UNE EPM Telecomunicaciones S.A.     
     * @param char text Texto que sera desencriptado.  Debe estar en formato 
     * hexadecimal (0a1fe7...).
     * @return char
     * @access public
     */
    public function lindecrypthex($enpass)
    {
        $recStr = "";

        for ($i = 0; $i < strlen($enpass); $i+=2) {
            $charac = isset($enpass[$i + 1]) ? $enpass[$i + 1] : '';
            $recStr.=chr(hexdec($enpass[$i] . $charac));
        }
        return $this->lindecrypt($recStr);
    }

    /**
     * Encripta un texto 2 veces, convinandolo en el segundo nivel 
     * con una constante y otra cadena. 
     * El resultado se entrega en forma hexadecimal (0a1fe7...).
     * @author  José Joaquín Bermúdez Correa <jjbermudez@cognox.com>
     * @version SVN:$Id: RijndaelHex.php 2249 2012-10-10 17:25:28Z jjbermudez@COGNOX $
     * @copyright 2012 UNE EPM Telecomunicaciones S.A.     
     * @param char text Texto que sera encriptado en el primer y segundo nivel.
     * @param char text2 Texto que sera encriptado en el segundo nivel.
     * @return char
     * @access public
     */
    public function linencrypthexComplex($text, $textTwo)
    {
        $encryp = $this->linencrypthex($text);

        $encryp = $this->linencrypthex($encryp . $this->myconst . $textTwo);

        return $encryp;
    }

    /**
     * Desencripta un texto que ha sido encriptado 2 veces.
     * El resultado se entrega en forma hexadecimal (0a1fe7...).
     * @author  José Joaquín Bermúdez Correa <jjbermudez@cognox.com>
     * @version SVN:$Id: RijndaelHex.php 2249 2012-10-10 17:25:28Z jjbermudez@COGNOX $
     * @copyright 2012 UNE EPM Telecomunicaciones S.A.     
     * @param char text Texto que sera desencriptado.
     * @return char
     * @access public
     */
    public function lindecrypthexComplex($text)
    {
        $decrypt = $this->lindecrypthex($text);
        $pieces = explode($this->myconst, $decrypt);

        $decrypt = $this->lindecrypthex($pieces[0]);

        return $decrypt;
    }

}