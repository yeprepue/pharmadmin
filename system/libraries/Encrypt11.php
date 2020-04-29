/ **
 * CodeIgniter
 * *
 * Un marco de desarrollo de aplicaciones de c�digo abierto para PHP 5.1.6 o m�s reciente
 * *
 * @package CodeIgniter
 * @author ExpressionEngine Dev Team
 * @copyright Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license http://codeigniter.com/user_guide/license.html
 * @link http://codeigniter.com
 * @since Versi�n 1.0
 * @filesource
 * /
// ------------------------------------------------ ------------------------
/ **
 * Clase de cifrado CodeIgniter
 * *
 * Proporciona codificaci�n codificada bidireccional usando XOR Hashing y Mcrypt
 * *
 * @package CodeIgniter
 * Bibliotecas @subpackage
 * @category Libraries
 * @author ExpressionEngine Dev Team
 * @link http://codeigniter.com/user_guide/libraries/encryption.html
 * /
clase  CI_Encrypt {
	var $ CI ;
	var $ encryption_key 	= '' ;
	var $ _hash_type 	= 'sha1' ;
	var $ _mcrypt_exists = FALSO ;
	var $ _mcrypt_cipher ;
	var $ _mcrypt_mode ;
	/ **
	 * Constructor
	 * *
	 * Simplemente determina si existe la biblioteca mcrypt.
	 * *
	 * /
	 funci�n  p�blica __construct ()
	{
		$ this -> CI = & get_instance ();
		$ this -> _mcrypt_exists = (! function_exists ( 'mcrypt_encrypt' ))? FALSO : VERDADERO ;
		log_message ( 'debug' , "Cifrar clase inicializada" );
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Obtener la clave de cifrado
	 * *
	 * Lo devuelve como MD5 para tener una clave de 128 bits de longitud exacta.
	 * Mcrypt es sensible a las teclas que no tienen la longitud correcta
	 * *
	 * @acceso p�blico
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  get_key ( $ key = '' )
	{
		if ( $ clave == '' )
		{
			if ( $ this -> encryption_key ! = '' )
			{
				devuelve  $ this -> encryption_key ;
			}
			$ CI = & get_instance ();
			$ key = $ CI -> config -> item ( 'encryption_key' );
			if ( $ clave == FALSO )
			{
				show_error ( 'Para usar la clase de cifrado requiere que establezca una clave de cifrado en su archivo de configuraci�n.' );
			}
		}
		return  md5 ( $ clave );
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Establecer la clave de cifrado
	 * *
	 * @acceso p�blico
	 * @param string
	 * @return void
	 * /
	funci�n  set_key ( $ key = '' )
	{
		$ this -> encryption_key = $ clave ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Codificar
	 * *
	 * Codifica la cadena del mensaje usando codificaci�n XOR bit a bit.
	 * La clave se combina con un hash aleatorio, y luego
	 * tambi�n se convierte usando XOR. Todo se ejecuta luego
	 * a trav�s de mcrypt (si es compatible) usando la clave aleatoria.
	 * El resultado final es una cadena de mensaje doblemente encriptada
	 * que se aleatoriza con cada llamada a esta funci�n,
	 * incluso si el mensaje y la clave suministrados son iguales.
	 * *
	 * @acceso p�blico
	 * @param string la cadena a codificar
	 * @param encadena la clave
	 * @cadena de retorno
	 * /
	 codificaci�n de funci�n ( $ string , $ key = '' )
	{
		$ key = $ this -> get_key ( $ key );
		if ( $ this -> _mcrypt_exists === TRUE )
		{
			$ enc = $ this -> mcrypt_encode ( $ cadena , $ clave );
		}
		m�s
		{
			$ enc = $ this -> _xor_encode ( $ cadena , $ clave );
		}
		return  base64_encode ( $ enc );
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Decodificar
	 * *
	 * Invierte el proceso anterior
	 * *
	 * @acceso p�blico
	 * @param string
	 * @param string
	 * @cadena de retorno
	 * /
	 decodificaci�n de funciones ( $ string , $ key = '' )
	{
		$ key = $ this -> get_key ( $ key );
		if ( preg_match ( '/ [^ a-zA-Z0-9 \ / \ + =] /' , $ cadena ))
		{
			volver  FALSO ;
		}
		$ dec = base64_decode ( $ cadena );
		if ( $ this -> _mcrypt_exists === TRUE )
		{
			if (( $ dec = $ this -> mcrypt_decode ( $ dec , $ key )) === FALSE )
			{
				volver  FALSO ;
			}
		}
		m�s
		{
			$ dec = $ this -> _xor_decode ( $ dec , $ clave );
		}
		return  $ dec ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Codificar desde el legado
	 * *
	 * Toma una cadena codificada de los algoritmos de clase de cifrado originales y
	 * devuelve una cadena reci�n codificada utilizando el m�todo mejorado agregado en 2.0.0
	 * Esto permite la compatibilidad con versiones anteriores y un m�todo para la transici�n a
	 * Nuevos algoritmos de cifrado.
	 * *
	 * Para m�s detalles, visite http://codeigniter.com/user_guide/installation/upgrade_200.html#encryption
	 * *
	 * @acceso p�blico
	 * @param string
	 * @param int (constante de modo mcrypt)
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  encode_from_legacy ( $ string , $ legacy_mode = MCRYPT_MODE_ECB , $ key = '' )
	{
		if ( $ this -> _mcrypt_exists === FALSE )
		{
			log_message ( 'error' , 'La codificaci�n del legado solo est� disponible cuando Mcrypt est� en uso' );
			volver  FALSO ;
		}
		// descifrarlo primero
		// establece el modo temporalmente a lo que era cuando la cadena se codific� con el legado
		// algoritmo - t�picamente MCRYPT_MODE_ECB
		$ current_mode = $ this -> _get_mode ();
		$ this -> set_mode ( $ legacy_mode );
		$ key = $ this -> get_key ( $ key );
		if ( preg_match ( '/ [^ a-zA-Z0-9 \ / \ + =] /' , $ cadena ))
		{
			volver  FALSO ;
		}
		$ dec = base64_decode ( $ cadena );
		if (( $ dec = $ this -> mcrypt_decode ( $ dec , $ key )) === FALSE )
		{
			volver  FALSO ;
		}
		$ dec = $ this -> _xor_decode ( $ dec , $ clave );
		// establece el modo mcrypt de nuevo a lo que deber�a ser, generalmente MCRYPT_MODE_CBC
		$ this -> set_mode ( $ current_mode );
		// y volver a codificar
		return  base64_encode ( $ this -> mcrypt_encode ( $ dec , $ key ));
	}
	// ------------------------------------------------ --------------------
	/ **
	 * XOR Encode
	 * *
	 * Toma una cadena de texto plano y una clave como entrada y genera un
	 * cadena de bits codificada usando XOR
	 * *
	 * @acceso privado
	 * @param string
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  _xor_encode ( $ string , $ key )
	{
		$ rand = '' ;
		while ( strlen ( $ rand ) < 32 )
		{
			$ rand . = mt_rand ( 0 , mt_getrandmax ());
		}
		$ rand = $ this -> hash ( $ rand );
		$ enc = '' ;
		para ( $ i = 0 ; $ i < strlen ( $ string ); $ i ++)
		{
			$ enc . = substr ( $ rand , ( $ i % strlen ( $ rand )), 1 ). ( substr ( $ rand , ( $ i % strlen ( $ rand )), 1 ) ^ substr ( $ string , $ i , 1 ));
		}
		devuelve  $ this -> _xor_merge ( $ enc , $ key );
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Decodificaci�n XOR
	 * *
	 * Toma una cadena codificada y una clave como entrada y genera el
	 * mensaje original de texto sin formato
	 * *
	 * @acceso privado
	 * @param string
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  _xor_decode ( $ string , $ key )
	{
		$ string = $ this -> _xor_merge ( $ string , $ key );
		$ dec = '' ;
		para ( $ i = 0 ; $ i < strlen ( $ string ); $ i ++)
		{
			$ dec . = ( substr ( $ cadena , $ i ++, 1 ) ^ substr ( $ cadena , $ i , 1 ));
		}
		return  $ dec ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Tecla XOR + Combinador de cuerdas
	 * *
	 * Toma una cadena y una clave como entrada y calcula la diferencia usando XOR
	 * *
	 * @acceso privado
	 * @param string
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  _xor_merge ( $ string , $ key )
	{
		$ hash = $ this -> hash ( $ clave );
		$ str = '' ;
		para ( $ i = 0 ; $ i < strlen ( $ string ); $ i ++)
		{
			$ str . = substr ( $ cadena , $ i , 1 ) ^ substr ( $ hash , ( $ i % strlen ( $ hash )), 1 );
		}
		devolver  $ str ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Cifrar usando Mcrypt
	 * *
	 * @acceso p�blico
	 * @param string
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  mcrypt_encode ( $ datos , $ clave )
	{
		$ init_size = mcrypt_get_iv_size ( $ this -> _get_cipher (), $ this -> _get_mode ());
		$ init_vect = mcrypt_create_iv ( $ init_size , MCRYPT_RAND );
		devuelve  $ this -> _add_cipher_noise ( $ init_vect . mcrypt_encrypt ( $ this -> _get_cipher (), $ key , $ data , $ this -> _get_mode (), $ init_vect ), $ key );
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Descifrar usando Mcrypt
	 * *
	 * @acceso p�blico
	 * @param string
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  mcrypt_decode ( $ datos , $ clave )
	{
		$ data = $ this -> _remove_cipher_noise ( $ datos , $ clave );
		$ init_size = mcrypt_get_iv_size ( $ this -> _get_cipher (), $ this -> _get_mode ());
		if ( $ init_size > strlen ( $ datos ))
		{
			volver  FALSO ;
		}
		$ init_vect = substr ( $ datos , 0 , $ init_size );
		$ datos = substr ( $ datos , $ init_size );
		return  rtrim ( mcrypt_decrypt ( $ this -> _get_cipher (), $ key , $ data , $ this -> _get_mode (), $ init_vect ), "\ 0" );
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Agrega ruido permutado a los datos encriptados IV + para proteger
	 * contra ataques Man-in-the-middle en cifrados de modo CBC
	 * http://www.ciphersbyritter.com/GLOSSARY.HTM#IV
	 * *
	 * Funci�n descriptiva
	 * *
	 * @acceso privado
	 * @param string
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  _add_cipher_noise ( $ datos , $ clave )
	{
		$ keyhash = $ this -> hash ( $ key );
		$ keylen = strlen ( $ keyhash );
		$ str = '' ;
		para ( $ i = 0 , $ j = 0 , $ len = strlen ( $ datos ); $ i < $ len ; ++ $ i , ++ $ j )
		{
			if ( $ j > = $ keylen )
			{
				$ j = 0 ;
			}
			$ str . = chr (( ord ( $ datos [ $ i ]) + ord ( $ keyhash [ $ j ]))% 256 );
		}
		devolver  $ str ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Elimina el ruido permutado de los datos encriptados IV +, invirtiendo
	 * _add_cipher_noise ()
	 * *
	 * Funci�n descriptiva
	 * *
	 * @acceso p�blico
	 * @param type
	 * @ tipo de devoluci�n
	 * /
	function  _remove_cipher_noise ( $ datos , $ clave )
	{
		$ keyhash = $ this -> hash ( $ key );
		$ keylen = strlen ( $ keyhash );
		$ str = '' ;
		para ( $ i = 0 , $ j = 0 , $ len = strlen ( $ datos ); $ i < $ len ; ++ $ i , ++ $ j )
		{
			if ( $ j > = $ keylen )
			{
				$ j = 0 ;
			}
			$ temp = ord ( $ datos [ $ i ]) - ord ( $ keyhash [ $ j ]);
			si ( $ temp < 0 )
			{
				$ temp = $ temp + 256 ;
			}
			$ str . = chr ( $ temp );
		}
		devolver  $ str ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Establecer el cifrado Mcrypt
	 * *
	 * @acceso p�blico
	 * @param constante
	 * @cadena de retorno
	 * /
	funci�n  set_cipher ( $ cifrado )
	{
		$ this -> _mcrypt_cipher = $ cifrado ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Establecer el modo Mcrypt
	 * *
	 * @acceso p�blico
	 * @param constante
	 * @cadena de retorno
	 * /
	funci�n  set_mode ( $ mode )
	{
		$ this -> _mcrypt_mode = $ modo ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Obtenga el valor de cifrado de Mcrypt
	 * *
	 * @acceso privado
	 * @cadena de retorno
	 * /
	funci�n  _get_cipher ()
	{
		if ( $ this -> _mcrypt_cipher == '' )
		{
			$ this -> _mcrypt_cipher = MCRYPT_RIJNDAEL_256 ;
		}
		devuelve  $ this -> _mcrypt_cipher ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Obtenga el valor del modo Mcrypt
	 * *
	 * @acceso privado
	 * @cadena de retorno
	 * /
	funci�n  _get_mode ()
	{
		if ( $ this -> _mcrypt_mode == '' )
		{
			$ this -> _mcrypt_mode = MCRYPT_MODE_CBC ;
		}
		devuelve  $ this -> _mcrypt_mode ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Establecer el tipo de hash
	 * *
	 * @acceso p�blico
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  set_hash ( $ type = 'sha1' )
	{
		$ this -> _hash_type = ( $ type ! = 'sha1' AND $ type ! = 'md5' )? 'sha1' : $ tipo ;
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Hash codifica una cadena
	 * *
	 * @acceso p�blico
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  hash ( $ str )
	{
		return ( $ this -> _hash_type == 'sha1' )? $ this -> sha1 ( $ str ): md5 ( $ str );
	}
	// ------------------------------------------------ --------------------
	/ **
	 * Generar un hash SHA1
	 * *
	 * @acceso p�blico
	 * @param string
	 * @cadena de retorno
	 * /
	funci�n  sha1 ( $ str )
	{
		if (! function_exists ( 'sha1' ))
		{
			if (! function_exists ( 'mhash' ))
			{
				require_once ( BASEPATH . 'bibliotecas / Sha1.php' );
				$ SH = nuevo  CI_SHA ;
				devolver  $ SH -> generar ( $ str );
			}
			m�s
			{
				return  bin2hex ( mhash ( MHASH_SHA1 , $ str ));
			}
		}
		m�s
		{
			return  sha1 ( $ str );
		}
	}
}
// END clase CI_Encrypt
/ * Fin del archivo Encrypt.php * /