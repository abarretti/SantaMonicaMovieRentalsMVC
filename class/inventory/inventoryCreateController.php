<?php

class InventoryCreateController
{
    private $inventory;
    private $inventoryDAO;

    public function __construct(Inventory $inventory, InventoryDAO $inventoryDAO)
    {
        $this->inventory= $inventory;
        $this->inventoryDAO= $inventoryDAO;
    }

  	public function insertRecord()
  	{
  		if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
      $this->inventory->setSKUNumber($_POST["sKUNumber"]);
      $this->inventory->setProductName($_POST["productName"]);
      $this->inventory->setProductionCompanyName($_POST["productionCompanyName"]);
      $this->inventory->setAction($_POST["action"]);
      $this->inventory->setChildren($_POST["children"]);
      $this->inventory->setComedy($_POST["comedy"]);
      $this->inventory->setDocumentary($_POST["documentary"]);
      $this->inventory->setDrama($_POST["drama"]);
      $this->inventory->setHorror($_POST["horror"]);
      $this->inventory->setMusicals($_POST["musicals"]);
      $this->inventory->setRomance($_POST["romance"]);
      $this->inventory->setScienceFiction($_POST["scienceFiction"]);
      $this->inventory->setThriller($_POST["thriller"]);
      $this->inventory->setBarCodeNumber($_POST["barCodeNumber"]);
      $this->inventory->setDateAcquired($_POST["dateAcquired"]);
      $this->inventory->setCondition($_POST["condition"]);
      $this->inventory->setGenreErr($this->inventory->getAction(), $this->inventory->getChildren(), $this->inventory->getComedy(), $this->inventory->getDocumentary(), $this->inventory->getDrama(), $this->inventory->getHorror(), $this->inventory->getMusicals(), $this->inventory->getRomance(), $this->inventory->getScienceFiction(), $this->inventory->getThriller());
    
      if($this->inventory->formInventoryCreateCheck($this->inventory->getSKUNumber(), $this->inventory->getProductName(), $this->inventory->getProductionCompanyName(), $this->inventory->getBarCodeNumber(), $this->inventory->getDateAcquired(), $this->inventory->getCondition(), $this->inventory->getSKUNumberErr(), $this->inventory->getProductNameErr(), $this->inventory->getProductionCompanyNameErr(), $this->inventory->getGenreErr(), $this->inventory->getBarCodeNumberErr(), $this->inventory->getDateAcquiredErr(), $this->inventory->getConditionErr())=="FORM COMPLETE")
      {
        echo $this->inventoryDAO->createInventoryRecord($this->inventory->getSKUNumber(), $this->inventory->getProductName(), $this->inventory->getProductionCompanyName(), $this->inventory->getAction(), $this->inventory->getChildren(), $this->inventory->getComedy(), $this->inventory->getDocumentary(), $this->inventory->getDrama(), $this->inventory->getHorror(), $this->inventory->getMusicals(), $this->inventory->getRomance(), $this->inventory->getScienceFiction(), $this->inventory->getThriller(), $this->inventory->getBarCodeNumber(), $this->inventory->getDateAcquired(), $this->inventory->getCondition());
      }
      }
  	}//functionClose

}//class end
?>