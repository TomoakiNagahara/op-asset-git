<?php
/**	op-asset-git:/launch.php
 *
 * @created    2024-12-01
 * @version    1.0
 * @package    op-asset-git
 * @author     Tomoaki Nagahara
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
$usage = "php git.php asset/git/launch.php display=1 debug=1";

//	...
if(!function_exists('OP') ){
	echo "Usage: {$usage}\n";
	exit(__LINE__);
}
