<?php

class Controller 
{
	private $model;

	public function __construct(Model $model)
	{
		$this->model= $model;
	}

	public function accountCreate()
	{
		$this->model->page = "accountCreate";
	}

	public function accountSearch()
	{
		$this->model->page = "accountSearch";
	}

	public function booking()
	{
		$this->model->page = "booking";
	}

	public function bookingCreate()
	{
		$this->model->page = "bookingCreate";
	}

	public function bookingSearch()
	{
		$this->model->page = "bookingSearch";
	}

	public function customers()
	{
		$this->model->page = "customers";
	}

	public function home()
	{
		$this->model->page = "home";
	}

	public function inventory()
	{
		$this->model->page = "inventory";
	}

	public function inventoryCreate()
	{
		$this->model->page = "inventoryCreate";
	}

	public function inventorySearch()
	{
		$this->model->page = "inventorySearch";
	}
}//class end

?>