<?php

namespace Controllers\Products;

use Controllers\PublicController;
use Utilities\Context;
use Utilities\Paging;
use Dao\Products\Products as DaoProducts;
use Views\Renderer;

class Products extends PublicController
{
  private $partialName = "";
  private $status = "";
  private $orderBy = "";
  private $orderDescending = false;
  private $pageNumber = 1;
  private $itemsPerPage = 5;
  private $viewData = [];
  private $products = [];
  private $productsCount = 0;
  private $pages = 0;

  public function run(): void
  {
    $this->getParams();
    
    $tmpProducts = DaoProducts::getProducts(
      $this->partialName,
      $this->status,
      $this->orderBy,
      $this->orderDescending,
      $this->pageNumber - 1,
      $this->itemsPerPage
    );

    $this->products = $tmpProducts["products"];
    $this->productsCount = $tmpProducts["total"];
    $this->pages = ceil($this->productsCount / $this->itemsPerPage);

    $this->viewData["products"] = $this->products;
    $this->viewData["partialName"] = $this->partialName;
    $this->viewData["status"] = $this->status;
    $this->viewData["productsCount"] = $this->productsCount;

    Renderer::render("products/products", $this->viewData);
  }

  private function getParams(): void
  {
    $this->partialName = $_GET["partialName"] ?? "";
    $this->status = $_GET["status"] ?? "";
    $this->orderBy = $_GET["orderBy"] ?? "";
    $this->orderDescending = isset($_GET["orderDescending"]) ? boolval($_GET["orderDescending"]) : false;
    $this->pageNumber = isset($_GET["pageNum"]) ? intval($_GET["pageNum"]) : 1;
  }
}