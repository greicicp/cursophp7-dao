<?php

	spl_autoload_register(function($class_name) { // função anônima de autoload com as standard php libraries

		$filename ="class".DIRECTORY_SEPARATOR.$class_name.".php";  // o arquivo de classe, encontra=-se na pasta class, no diretório específ

		if (file_exists(($filename))) {
			require_once($filename);
		}


	});

?>