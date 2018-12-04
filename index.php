<?php
class CaesarCipher{

	public $shift;

	// alfabeto composto por dois arrays com letras em minusculo e maiusculo
	const alphabet = array(
        "lowercase" => array("a","b","c","d","e","f","g","h","i","j","l","m","n","o","p","q","r","s","t","u","v","z","x"),
        "uppercase" => array("A","B","C","D","E","F","G","H","I","J","L","M","N","O","P","Q","R","S","T","U","V","Z","X")
      );

	// construtor atribuindo o valor inical da chave em 0
	public function __construct($shift = 0){
		$this->shift = $shift % 26;
	}
	// funcção para encripta o texto
	public function encrypt($input){

		// armazena a entrada dividindo ela em letras
        $result = str_split($input);
		for ($i = 0; $i < count($result); $i++) {
			for ($j = 0; $j < 23; $j++) {
				// verifica se a proxima letra é minuscula
				if ($result[$i] === CaesarCipher::alphabet["lowercase"][$j]) {
					// result recebe a letra armazenada na rotação 
                    // que é formada pela soma de j com 23, subtraindo o valor da chave, mod de 23
					$result[$i] = CaesarCipher::alphabet["lowercase"][($j + $this->shift) % 23];
					$j = 23;
				  // verifica se a proxima letra é maiusculo
				} elseif ($result[$i] === CaesarCipher::alphabet["uppercase"][$j]) {
					// result recebe a letra armazenada na rotação 
                    // que é formada pela soma de j com 23, subtraindo o valor da chave, mod de 23
					$result[$i] = CaesarCipher::alphabet["uppercase"][($j + $this->shift) % 23];
					$j = 23;
				}
			}
		}
		// converte o resultado em uma matriz na mesma ordem
		// e com uma ligação entre cada elemento
		$result = implode($result);
		// retorna o texto cifrado
		return $result;
    }
    
	// decripta o texto, processo inverso do de encriptar o texto
	public function decrypt($input){

		$result = str_split($input);
		for ($i = 0; $i < count($result); $i++) {
			for ($j = 0; $j < 23; $j++) {
                // verifica se a proxima letra é minuscula
				if ($result[$i] === CaesarCipher::alphabet["lowercase"][$j]) {
					// result recebe a letra armazenada na rotação 
                    // que é formada pela soma de j com 23, subtraindo o valor da chave, mod de 23
					$result[$i] = CaesarCipher::alphabet["lowercase"][($j + 23 - $this->shift) % 23];
                    $j = 23;
                  // verifica se a proxima letra é maiusculo
				} elseif ($result[$i] === CaesarCipher::alphabet["uppercase"][$j]) {
                    // result recebe a letra armazenada na rotação que é formada 
                    // pela soma de j com 23, subtraindo o valor da chave, mod de 23
					$result[$i] = CaesarCipher::alphabet["uppercase"][($j + 23 - $this->shift) % 23];
					$j = 23;
				}
			}
        }
        
		// converte o resultado em uma matriz na mesma ordem
		// e com uma ligação entre cada elemento
		$result = implode($result);
		// retorna o texto cifrado
		return $result;
	}
}


// instacia a classe de cifra de cesar, atribui o valor da chave
$cipher = new CaesarCipher(1045);
// imprime o valor do texto chamando a função de encriptar
echo "Text: Marcos Paulo da Silva = " . $cipher->encrypt("Marcos Paulo da Silva");

echo "</br>";
$cipher = new CaesarCipher(678);
echo "Text: Instituto Federal = " . $cipher->encrypt("Instituto Federal");

echo "</br>";

$cipher = new CaesarCipher(5);
echo $cipher->decrypt("Jijmpmttwewztljijm");