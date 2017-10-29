<?php

class BookingSearchController
{
    private $booking;
    private $customer;
    private $inventory;
    private $bookingDAO;

    public function __construct(Booking $booking, Customer $customer, Inventory $inventory, BookingDAO $bookingDAO)
    {
        $this->booking= $booking;
        $this->customer= $customer;
        $this->inventory= $inventory;
        $this->bookingDAO= $bookingDAO;
    }

  	public function searchRecord()
  	{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $this->customer->setLastNameOptional($_POST["lastName"]);
      $this->customer->setDateOfBirth($_POST["dateOfBirth"]);
      $this->customer->setAddress1Optional($_POST["address1"]);
      $this->customer->setPhoneNumber($_POST["phoneNumber"]);

      $this->inventory->setBarCodeNumberOptional($_POST["barCodeNumber"]);
      $this->inventory->setSKUNumberOptional($_POST["sKUNumber"]);
      $this->inventory->setProductNameOptional($_POST["productName"]);

      //SUBMIT RETURN
      if (isset($_POST["submitReturn"]))
      {
        $this->booking->setBookingFormBarcodeNumbers($_SESSION["inventoryCount"], $_POST["barCodeNumber1"], $_POST["barCodeNumber2"], $_POST["barCodeNumber3"], $_POST["barCodeNumber4"], $_POST["barCodeNumber5"], $_POST["barCodeNumber6"], $_POST["barCodeNumber7"], $_POST["barCodeNumber8"], $_POST["barCodeNumber9"],$_POST["barCodeNumber10"]);
        
        $this->booking->setReturnDate($_POST["returnDate"]);

        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);

        $_SESSION["returnDate"]= $this->booking->getReturnDate();
        $_SESSION["returnDateErr"]= $this->booking->getReturnDateErr();

        $_SESSION["barCodeNumberDuplicateErr"]= $this->booking->getBarCodeNumberErr("d");
        echo $_SESSION["barCodeNumberDuplicateErr"];
        $_SESSION["barCodeNumber1Err"]= $this->booking->getBarCodeNumberErr(1);
        $_SESSION["barCodeNumber2Err"]= $this->booking->getBarCodeNumberErr(2);
        $_SESSION["barCodeNumber3Err"]= $this->booking->getBarCodeNumberErr(3);
        $_SESSION["barCodeNumber4Err"]= $this->booking->getBarCodeNumberErr(4);
        $_SESSION["barCodeNumber5Err"]= $this->booking->getBarCodeNumberErr(5);
        $_SESSION["barCodeNumber6Err"]= $this->booking->getBarCodeNumberErr(6);
        $_SESSION["barCodeNumber7Err"]= $this->booking->getBarCodeNumberErr(7);
        $_SESSION["barCodeNumber8Err"]= $this->booking->getBarCodeNumberErr(8);
        $_SESSION["barCodeNumber9Err"]= $this->booking->getBarCodeNumberErr(9);
        $_SESSION["barCodeNumber10Err"]= $this->booking->getBarCodeNumberErr(10);

        if ($this->booking->formSubmitReturnCheck($_SESSION["barCodeNumber1"], $_SESSION["returnDate"], $_SESSION["returnDateErr"], $_SESSION["barCodeNumberDuplicateErr"], $_SESSION["barCodeNumber1Err"], $_SESSION["barCodeNumber2Err"], $_SESSION["barCodeNumber3Err"], $_SESSION["barCodeNumber4Err"], $_SESSION["barCodeNumber5Err"], $_SESSION["barCodeNumber6Err"], $_SESSION["barCodeNumber7Err"], $_SESSION["barCodeNumber8Err"], $_SESSION["barCodeNumber9Err"], $_SESSION["barCodeNumber10Err"])=="FORM COMPLETE")
        {
          echo $this->bookingDAO->returnBooking($_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"], $_SESSION["returnDate"]);
        }
      }

      //Add and Remove Inventory Items
      if (isset($_POST["addItem"]))
      {
        $_SESSION["inventoryCount"]= $_SESSION["inventoryCount"]+1;
        $this->booking->setInventoryCount($_SESSION["inventoryCount"]);
        $_SESSION["inventoryCount"]= $this->booking->getInventoryCount();
      }

      if (isset($_POST["removeItem"]))
      { 
        $_SESSION["inventoryCount"]= $_SESSION["inventoryCount"]-1;
        $this->booking->setInventoryCount($_SESSION["inventoryCount"]);
        $_SESSION["inventoryCount"]= $this->booking->getInventoryCount();
        
          //clears variable if inventory item is removed
          $this->booking->clearBarCodeNumber($_SESSION["inventoryCount"]);
          $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
          $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
          $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
          $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
          $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
          $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
          $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
          $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
          $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
          $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
          $_SESSION["barCodeNumber1Err"]= $this->booking->getBarCodeNumberErr(1);
        $_SESSION["barCodeNumber2Err"]= $this->booking->getBarCodeNumberErr(2);
        $_SESSION["barCodeNumber3Err"]= $this->booking->getBarCodeNumberErr(3);
        $_SESSION["barCodeNumber4Err"]= $this->booking->getBarCodeNumberErr(4);
        $_SESSION["barCodeNumber5Err"]= $this->booking->getBarCodeNumberErr(5);
        $_SESSION["barCodeNumber6Err"]= $this->booking->getBarCodeNumberErr(6);
        $_SESSION["barCodeNumber7Err"]= $this->booking->getBarCodeNumberErr(7);
        $_SESSION["barCodeNumber8Err"]= $this->booking->getBarCodeNumberErr(8);
        $_SESSION["barCodeNumber9Err"]= $this->booking->getBarCodeNumberErr(9);
        $_SESSION["barCodeNumber10Err"]= $this->booking->getBarCodeNumberErr(10);
      }
      
      //Customer Search
      if (isset($_POST["submitCustomer"]) and $this->customer->formBookingCustomerSearchCheck($this->customer->getLastNameErr(), $this->customer->getAddress1Err(), $this->customer->getPhoneNumberErr())=="FORM COMPLETE")
      {
        $_SESSION["inventoryList"]= $this->bookingDAO->bookingSearchCustomerQuery($this->customer->getLastName(), $this->customer->getDateOfBirth(), $this->customer->getAddress1(), $this->customer->getPhoneNumber());
      }
      
      //Inventory Search
      if (isset($_POST["submitProduct"]) and $this->inventory->formBookingInventorySearchCheck($this->inventory->getBarCodeNumberErr(), $this->inventory->getSKUNumberErr(), $this->inventory->getProductNameErr())=="FORM COMPLETE")
      {
        $_SESSION["inventoryList"]= $this->bookingDAO->bookingSearchInventoryQuery($this->inventory->getBarCodeNumber(), $this->inventory->getSKUNumber(), $this->inventory->getProductName());
      }

      //Sets Booking BarCode from Customer and Inventory Searches
      if (isset($_POST["barCodeSelect0"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][0],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_POST["barCodeSelect1"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][1],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_POST["barCodeSelect2"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][2],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_POST["barCodeSelect3"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][3],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_POST["barCodeSelect4"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][4],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_POST["barCodeSelect5"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][5],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_POST["barCodeSelect6"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][6],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_POST["barCodeSelect7"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][7], $_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_POST["barCodeSelect8"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][8],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_POST["barCodeSelect9"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][9],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }
    }
  	}//functionClose

}//class end
?>