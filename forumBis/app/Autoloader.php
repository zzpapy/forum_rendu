<?php
	namespace App;
	
	class Autoloader{

		public static function register(){
			spl_autoload_register(array(__CLASS__, 'autoload'));
		}
 
		public static function autoload($class){
			// on explose notre variable $class par \
			$parts = preg_split('#\\\#', $class);

			// on extrait le dernier element 
			$className = array_pop($parts);

			// on créé le chemin vers la classe
			// on utilise DS car plus propre et meilleure portabilité entre les différents systèmes (windows/linux) 

			$path = implode(DS, $parts);
			$file = $className.'.php';

			$filepath = BASE_DIR.strtolower($path).DS.$file;
			if(file_exists($filepath)){
				require $filepath;
			}
			
		}
	}
