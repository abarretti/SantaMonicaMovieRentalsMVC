<?php

class AccountCreateController
{
    private $customer;
    private $customerDAO;

    public function __construct(Customer $customer, CustomerDAO $customerDAO)
    {
        $this->customer= $customer;
        $this->customerDAO= $customerDAO;
    }

  	public function insertRecord()
  	{
  		$this->customer->setFirstName($_POST["firstName"]);
      $this->customer->setLastName($_POST["lastName"]);
      $this->customer->setDateOfBirth($_POST["dateOfBirth"]);
      $this->customer->setGender($_POST["gender"]);
      $this->customer->setAddress1($_POST["address1"]);
      $this->customer->setAddress2($_POST["address2"]);
      $this->customer->setCity($_POST["city"]);
      $this->customer->setState($_POST["state"]);
      $this->customer->setPhoneNumber($_POST["phoneNumber"]);
      $this->customer->setEmailAddress($_POST["eMail"]);  
      $this->customer->setPassword($_POST["password"],$_POST["passwordRepeat"]);
      $this->customer->setAction($_POST["action"]);
      $this->customer->setChildren($_POST["children"]);
      $this->customer->setComedy($_POST["comedy"]);
      $this->customer->setDocumentary($_POST["documentary"]);
      $this->customer->setDrama($_POST["drama"]);
      $this->customer->setHorror($_POST["horror"]);
      $this->customer->setMusicals($_POST["musicals"]);
      $this->customer->setRomance($_POST["romance"]);
      $this->customer->setScienceFiction($_POST["scienceFiction"]);
      $this->customer->setThriller($_POST["thriller"]);
      $this->customer->setNotes($_POST["notes"]);
    
    //Database Insert
   if ($this->customer->formCustomerCreateCheck($this->customer->getFirstNameErr(), $this->customer->getLastNameErr(), $this->customer->getGenderErr(), $this->customer->getAddress1Err(), $this->customer->getCityErr(), $this->customer->getStateErr(), $this->customer->getPhoneNumberErr(), $this->customer->getEMailErr(), $this->customer->getPasswordErr(), $this->customer->getPasswordRepeatErr(), $this->customer->getFirstName(), $this->customer->getLastName(), $this->customer->getGender(), $this->customer->getAddress1(), $this->customer->getCity(), $this->customer->getState(), $this->customer->getEMailAddress(), $this->customer->getPassword(), $this->customer->getPasswordRepeat())=="FORM COMPLETE")
    {
    echo $this->customerDAO->createCustomerRecord($this->customer->getFirstName(), $this->customer->getLastName(),$this->customer->getDateOfBirth(), $this->customer->getGender(), $this->customer->getAddress1(), $this->customer->getAddress2(), $this->customer->getCity(), $this->customer->getState(), $this->customer->getPhoneNumber(), $this->customer->getEmailAddress(), $this->customer->getPassword(), $this->customer->getAction(), $this->customer->getChildren(), $this->customer->getComedy(), $this->customer->getDocumentary(), $this->customer->getDrama(), $this->customer->getHorror(), $this->customer->getMusicals(), $this->customer->getRomance(), $this->customer->getScienceFiction(), $this->customer->getThriller(), $this->customer->getNotes());
		}
  	}//functionClose

}//class end
?>