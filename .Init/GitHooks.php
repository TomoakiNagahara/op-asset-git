<?php
/**	op-asset-model:/.Init/GitHooks.php
 *
 * @created   2025-10-02
 * @version   1.0
 * @package   op-asset-model
 * @author    Tomoaki Nagahara
 * @copyright Tomoaki Nagahara All right reserved.
 */

/**	declare
 *
 */
declare(strict_types=1);

/**	namespace
 *
 */
namespace OP;

/** Detect super project root (submodule-only)
 *
 */
if( $git_root = trim(`git rev-parse --show-superproject-working-tree 2>/dev/null`) ){
	$git_root = realpath($git_root); // Use absolute path to ensure Git accepts a hooksPath outside the submodule.
	$op_hooks = "{$git_root}/asset/git/hooks/";
}else{
	//	Fail if current repo is not a submodule.
	echo "\nError: Git root was not found.\n\n";
	exit(__LINE__);
}

/** Check directory exists
 *
 */
if(!is_dir($op_hooks)){
	echo "\nError: This directory was not found: {$op_hooks}\n\n";
	exit(__LINE__);
}

/** Register OP hooks into *this submodule* repo
 *
 */
$path = escapeshellarg($op_hooks);
`git config core.hooksPath {$path}`;

/** Verify
 *
 */
if( $op_hooks === ($hooks_path = trim(`git config --get core.hooksPath 2>/dev/null`)) ){
	echo "OK: core.hooksPath is set to {$hooks_path}\n";
}else{
	echo "\nError: Failed to set core.hooksPath. Current: {$hooks_path}\n\n";
	exit(__LINE__);
}
