<?php

class AccountSearchController
{
    private $customer;
    private $customerDAO;

    public function __construct(Customer $customer, CustomerDAO $customerDAO)
    {
        $this->customer= $customer;
        $this->customerDAO= $customerDAO;
    }

  	public function searchRecord()
  	{  
      $this->customer->setFirstNameOptional($_POST["firstName"]);
      $this->customer->setLastNameOptional($_POST["lastName"]);
      $this->customer->setDateOfBirth($_POST["dateOfBirth"]);
      $this->customer->setGenderOptional($_POST["gender"]);
      $this->customer->setAddress1Optional($_POST["address1"]);
      $this->customer->setCityOptional($_POST["city"]);
      $this->customer->setStateOptional($_POST["state"]);
      $this->customer->setPhoneNumber($_POST["phoneNumber"]);
      $this->customer->setEmailAddressOptional($_POST["eMail"]);
    
      if (isset($_POST["submitPersonal"]) and $this->customer->formCustomerPersonalSearchCheck($this->customer->getFirstNameErr(), $this->customer->getLastNameErr())=="FORM COMPLETE")
      { 
        //Personal Info Database Query
        $this->customerDAO->personalInformationQuery($this->customer->getFirstName(), $this->customer->getLastName(), $this->customer->getDateOfBirth(), $this->customer->getGender());
      }

      if (isset($_POST["submitAddress"]) and $this->customer->formCustomerAddressSearchCheck($this->customer->getAddress1Err(), $this->customer->getCityErr(), $this->customer->getPhoneNumberErr())=="FORM COMPLETE")
      {
        //Address Info Database Query
        $this->customerDAO->addressInformationQuery($this->customer->getAddress1(), $this->customer->getCity(), $this->customer->getState(), $this->customer->getPhoneNumber());
      }

      if (isset($_POST["submitEMail"]) and $this->customer->formCustomerEMailSearchCheck($this->customer->getEMailErr())=="FORM COMPLETE")
      {
        //Email Database Query
        $this->customerDAO->eMailInformationQuery($this->customer->getEMailAddress()); 
      }
  	}//functionClose

}//class end
?>