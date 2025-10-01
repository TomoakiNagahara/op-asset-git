<?php
/** op-asset-git:/pull.php
 *
 * <pre>
 * ```sh
 * php app.php _develop/git/pull
 * ```
 * </pre>
 *
 * @created    2025-10-01
 * @version    1.0
 * @package    op-asset-git
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//	...
$remote = OP()->Request('remote') ?? 'origin';
$branch = OP()->Request('branch') ?? '2030';
D($remote, $branch);

//	...
D('Core');
chdir(_ROOT_CORE_);
`git submodule foreach git pull {$remote} {$branch}`;

//	...
D('Submodules');
chdir(_ROOT_GIT_);
`git submodule foreach git pull {$remote} {$branch}`;

//	...
D('Skeleton');
chdir(_ROOT_GIT_);
`git pull {$remote} {$branch}`;
