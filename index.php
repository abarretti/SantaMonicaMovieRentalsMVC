<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<?php

require dirname(__FILE__).'/class/mainModel.php';
require dirname(__FILE__).'/class/headView.php';
require dirname(__FILE__).'/class/headerView.php';
require dirname(__FILE__).'/class/classRouter.php';
require dirname(__FILE__).'/class/footerView.php';
require dirname(__FILE__).'/class/mainController.php';

$model = new Model();
$classRouter = new ClassRouter($model);
$headView = new HeadView($model);
$headerView = new HeaderView($model);
$footerView = new FooterView($model);
$controller= new Controller($model);

if (isset($_GET['action']))
{
	$controller->{$_GET['action']}();
}

echo $headView->output();
echo $headerView->output();
$classRouter->output($model->page);
echo $footerView->output();

?>
</html>

<!-- php Desktop/PHP/SantaMonicaMovieRentalsMVC/index.php -->