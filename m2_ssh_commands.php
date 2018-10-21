<?php
error_reporting(1);
ini_set('max_execution_time', 0);
require __DIR__ . '/app/bootstrap.php';

$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();
$storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');

?>

<html>
	<head>		
		<title>Commands Executor</title>
	</head>
	<body>
		<form action="<?php echo $storeManager->getStore()->getBaseUrl(); ?>" id="commands" type="post">
			<center>
				<h1> Select command from below list</h1>
			<select name="command">
				<option>Option Select Operation</option>
				<option value="cache_clean">Cache Clean</option>
				<option value="cache_flush">Cache Flush</option>
				<option value="reindex">Reindex</option>
				<option value="setup_upgrade">Setup Upgrade</option>
				<option value="deploy">Deploy</option>
				<option value="permission">Folder Permission Without Sudo</option>
				<option value="sudo_permission">Folder Permission with Sudo</option>
			</select>
			<button type="submit" form="commands" value="Submit">Submit</button>
			</center>
		</form>

		<?php
		if(isset($_GET['command'])){
			$task = $_GET['command'];
			switch ($task) {
				case 'cache_clean':
					$command = 'php '.__DIR__.'/bin/magento cache:clean';
    				echo '<pre>' . shell_exec($command) . '</pre>';
					break;

				case 'cache_flush':
					$command = 'php '.__DIR__.'/bin/magento cache:flush';
    				echo '<pre>' . shell_exec($command) . '</pre>';
					break;

				case 'reindex':
					$command = 'php '.__DIR__.'/bin/magento indexer:reindex';
    				echo '<pre>' . shell_exec($command) . '</pre>';
					break;

				case 'setup_upgrade':
					$command = 'php '.__DIR__.'/bin/magento setup:upgrade';
    				echo '<pre>' . shell_exec($command) . '</pre>';
					break;

				case 'deploy':
					$command = 'php '.__DIR__.'/bin/magento setup:static-content:deploy -f';
    				echo '<pre>' . shell_exec($command) . '</pre>';
					break;

				case 'permission':
					$command = 'chmod -R 777 '.__DIR__.'/var/ '.__DIR__.'/pub/ '.__DIR__.'/generated/ ';
    				echo '<pre>' . shell_exec($command) . '</pre>';
					break;

				case 'sudo_permission':
					//$command = 'sudo chmod -R 777 '.__DIR__.'/var/ '.__DIR__.'/pub/ '.__DIR__.'/generated/ ';
    				//echo '<pre>' . shell_exec($command) . '</pre>';
					echo "Please Run this command from Shell.";
					break;
				
				default:
					echo "Please select Command";
					break;
			}
		}
		?>		
	</body>
</html>

