<?php
/**	op-skeleton-2024:/asset/git/cd.php
 *
 * Direct execute code delivery.
 *
 * <pre>
 * ```sh
 * php git.php asset/git/cd.php config=github
 * ```
 * </pre>
 *
 * @created    2024-11-18
 * @version    1.0
 * @package    op-skeleton-2024
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	Declare strict
 *
 */
declare(strict_types=1);

/**	namespace
 *
 */
namespace OP;

//	...
if(!function_exists('OP') ){
	echo "Does not initialized op-core. \n";
	echo "Usage: php git.php asset/git/cd.php \n";
	exit(__LINE__);
}

//	...
if(!$name = OP()->Request('name') ){
	echo "Config file name is not specified.\n";
	echo "Usage: php git.php asset/git/cd.php name=github \n";
	exit(__LINE__);
}

//	...
$action = "/www/op/cd2/action.php";
$config = OP()->Path("asset:/config/cd2-{$name}.php");
$comand = "php {$action} config={$config}";

//	...
foreach( [$action, $config] as $path ){
	//	...
	if(!file_exists($path) ){
		echo "This file does not exists: {$path} \n";
		exit(__LINE__);
	}
}

//	...
$output = null;
$status = null;
exec($comand, $output, $status);

//	...
echo join(PHP_EOL, $output) . PHP_EOL;
