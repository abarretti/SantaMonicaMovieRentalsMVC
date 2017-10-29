<?php

class InventorySearchController
{
    private $inventory;
    private $inventoryDAO;

    public function __construct(Inventory $inventory, InventoryDAO $inventoryDAO)
    {
        $this->inventory= $inventory;
        $this->inventoryDAO= $inventoryDAO;
    }

  	public function searchRecord()
  	{
      if ($_SERVER["REQUEST_METHOD"] == "POST")  
      {
        $this->inventory->setSKUNumberOptional($_POST["sKUNumber"]);
        $this->inventory->setProductNameOptional($_POST["productName"]);
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

        if (isset($_POST["submitSKUProduct"]) and $this->inventory->formInventorySearchCheck($this->inventory->getSKUNumberErr(), $this->inventory->getProductNameErr())=="FORM COMPLETE")
        {
          $this->inventoryDAO->productInventoryQuery($this->inventory->getSKUNumber(), $this->inventory->getProductName());
        }
    
        if (isset($_POST["submitProductionGenre"]))
        {
          $this->inventoryDAO->companyGenreQuery($this->inventory->getProductionCompanyName(), $this->inventory->getAction(), $this->inventory->getChildren(), $this->inventory->getComedy(), $this->inventory->getDocumentary(), $this->inventory->getDrama(), $this->inventory->getHorror(), $this->inventory->getMusicals(), $this->inventory->getRomance(), $this->inventory->getScienceFiction(), $this->inventory->getThriller());
        }
      }

  	}//functionClose

}//class end
?>