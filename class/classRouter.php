<?php

class ClassRouter
{
	private $model;
	public $functionalModel;
	public $DAOModel;

	public function __construct(Model $model)
	{
		$this->model= $model;
	}

	public function output($page)
	{
		if ($page=="home")
		{
			require dirname(__FILE__).'/home/homeView.php';

			$homeView= new HomeView();

			echo $homeView->output();
		}

		if ($page=="inventory")
		{
			require dirname(__FILE__).'/inventory/inventoryView.php';

			$inventoryView= new InventoryView();

			echo $inventoryView->output();
		}

		if ($page=="booking")
		{
			require dirname(__FILE__).'/booking/bookingView.php';

			$bookingView= new BookingView();

			echo $bookingView->output();
		}

		if ($page=="customers")
		{
			require dirname(__FILE__).'/customer/customersView.php';

			$customersView= new CustomersView();

			echo $customersView->output();
		}

		if ($page=="accountSearch")
		{
			require dirname(__FILE__).'/customer/customerModel.php';
			require dirname(__FILE__).'/customer/DAOcustomerModel.php';
			require dirname(__FILE__).'/customer/accountSearchView.php';
			require dirname(__FILE__).'/customer/accountSearchController.php';

			$customer= new Customer();
			$customerDAO= new CustomerDAO();
			$accountSearchView= new AccountSearchView($customer);
			$accountSearchController= new AccountSearchController($customer, $customerDAO);

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$accountSearchController->searchRecord();
			}

			echo $accountSearchView->output();
		}

		if ($page=="accountCreate")
		{
			require dirname(__FILE__).'/customer/customerModel.php';
			require dirname(__FILE__).'/customer/DAOcustomerModel.php';
			require dirname(__FILE__).'/customer/accountCreateView.php';
			require dirname(__FILE__).'/customer/accountCreateController.php';

			$customer= new Customer();
			$customerDAO= new CustomerDAO();
			$accountCreateView= new AccountCreateView($customer);
			$accountCreateController= new AccountCreateController($customer, $customerDAO);

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$accountCreateController->insertRecord();
			}

			echo $accountCreateView->output();
		}

		if ($page=="inventoryCreate")
		{
			require dirname(__FILE__).'/inventory/inventoryModel.php';
			require dirname(__FILE__).'/inventory/DAOinventoryModel.php';
			require dirname(__FILE__).'/inventory/inventoryCreateView.php';
			require dirname(__FILE__).'/inventory/inventoryCreateController.php';

			$inventory= new Inventory();
			$inventoryDAO= new InventoryDAO();
			$inventoryCreateView= new InventoryCreateView($inventory, $inventoryDAO);
			$inventoryCreateController= new InventoryCreateController($inventory, $inventoryDAO);

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$inventoryCreateController->insertRecord();
			}

			echo $inventoryCreateView->output();
		}

		if ($page=="inventorySearch")
		{
			require dirname(__FILE__).'/inventory/inventoryModel.php';
			require dirname(__FILE__).'/inventory/DAOinventoryModel.php';
			require dirname(__FILE__).'/inventory/inventorySearchView.php';
			require dirname(__FILE__).'/inventory/inventorySearchController.php';

			$inventory= new Inventory();
			$inventoryDAO= new InventoryDAO();
			$inventorySearchView= new InventorySearchView($inventory, $inventoryDAO);
			$inventorySearchController= new InventorySearchController($inventory, $inventoryDAO);

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$inventorySearchController->searchRecord();
			}

			echo $inventorySearchView->output();
		}

		if ($page=="bookingCreate")
		{
			require dirname(__FILE__).'/booking/bookingModel.php';
			require dirname(__FILE__).'/booking/DAObookingModel.php';
			require dirname(__FILE__).'/booking/bookingCreateView.php';
			require dirname(__FILE__).'/booking/bookingCreateController.php';
			require dirname(__FILE__).'/customer/customerModel.php';
			require dirname(__FILE__).'/inventory/inventoryModel.php';

			$booking= new Booking($_SESSION["bookingEMail"],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"], $_SESSION["bookingDate"], NULL, $_SESSION["bookingEMailAddressErr"],$_SESSION["barCodeNumberDuplicateErr"], $_SESSION["barCodeNumber1Err"], $_SESSION["barCodeNumber2Err"], $_SESSION["barCodeNumber3Err"], $_SESSION["barCodeNumber4Err"], $_SESSION["barCodeNumber5Err"], $_SESSION["barCodeNumber6Err"], $_SESSION["barCodeNumber7Err"], $_SESSION["barCodeNumber8Err"], $_SESSION["barCodeNumber9Err"], $_SESSION["barCodeNumber10Err"], $_SESSION["bookingDateErr"],NULL);
			$customer= new Customer();
			$inventory= new Inventory();
			$bookingDAO= new BookingDAO();
			$bookingCreateView= new BookingCreateView($booking, $customer, $inventory);
			$bookingCreateController= new BookingCreateController($booking, $customer, $inventory, $bookingDAO);

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$bookingCreateController->insertRecord();
			}

			echo $bookingCreateView->output();
		}

		if ($page=="bookingSearch")
		{
			require dirname(__FILE__).'/booking/bookingModel.php';
			require dirname(__FILE__).'/booking/DAObookingModel.php';
			require dirname(__FILE__).'/booking/bookingSearchView.php';
			require dirname(__FILE__).'/booking/bookingSearchController.php';
			require dirname(__FILE__).'/customer/customerModel.php';
			require dirname(__FILE__).'/inventory/inventoryModel.php';

			$booking= new Booking($_SESSION["bookingEMail"],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"], $_SESSION["bookingDate"], $_SESSION["returnDate"],$_SESSION["bookingEMailAddressErr"],$_SESSION["barCodeNumberDuplicateErr"], $_SESSION["barCodeNumber1Err"], $_SESSION["barCodeNumber2Err"], $_SESSION["barCodeNumber3Err"], $_SESSION["barCodeNumber4Err"], $_SESSION["barCodeNumber5Err"], $_SESSION["barCodeNumber6Err"], $_SESSION["barCodeNumber7Err"], $_SESSION["barCodeNumber8Err"], $_SESSION["barCodeNumber9Err"], $_SESSION["barCodeNumber10Err"], $_SESSION["bookingDateErr"], $_SESSION["returnDateErr"]);
			$customer= new Customer();
			$inventory= new Inventory();
			$bookingDAO= new BookingDAO();
			$bookingSearchView= new BookingSearchView($booking, $customer, $inventory);
			$bookingSearchController= new BookingSearchController($booking, $customer, $inventory, $bookingDAO);

		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$bookingSearchController->searchRecord();
		}

			echo $bookingSearchView->output();
		}
	
	}//function end
}//class end

?>