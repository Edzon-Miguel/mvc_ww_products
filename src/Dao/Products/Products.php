<?php
namespace Dao\Products;

use Dao\Table;

class Products extends Table {

  public static function getProducts(
    string $partialName = "",
    string $status = "",
    string $orderBy = "",
    bool $orderDescending = false,
    int $page = 0,
    int $itemsPerPage = 10
  ) {

    $sqlstr = "SELECT p.productId,
                      p.productName,
                      p.productDescription,
                      p.productPrice,
                      p.productImgUrl,
                      p.productStatus,
                      CASE 
                        WHEN p.productStatus = 'ACT' THEN 'Activo'
                        WHEN p.productStatus = 'INA' THEN 'Inactivo'
                        ELSE 'Sin Asignar'
                      END as productStatusDsc
               FROM products p";

    $sqlstrCount = "SELECT COUNT(*) as count FROM products p";

    $conditions = [];
    $params = [];

    if ($partialName != "") {
      $conditions[] = "p.productName LIKE :partialName";
      $params["partialName"] = "%" . $partialName . "%";
    }

    if (!in_array($status, ["ACT", "INA", ""])) {
      throw new \Exception("Status inválido");
    }

    if ($status != "") {
      $conditions[] = "p.productStatus = :status";
      $params["status"] = $status;
    }

    if (count($conditions) > 0) {
      $sqlstr .= " WHERE " . implode(" AND ", $conditions);
      $sqlstrCount .= " WHERE " . implode(" AND ", $conditions);
    }

    if (!in_array($orderBy, ["productId", "productName", "productPrice", ""])) {
      throw new \Exception("OrderBy inválido");
    }

    if ($orderBy != "") {
      $sqlstr .= " ORDER BY " . $orderBy;
      if ($orderDescending) {
        $sqlstr .= " DESC";
      }
    }

    $numeroDeRegistros = self::obtenerUnRegistro($sqlstrCount, $params)["count"];

    $sqlstr .= " LIMIT " . ($page * $itemsPerPage) . ", " . $itemsPerPage;

    $registros = self::obtenerRegistros($sqlstr, $params);

    return [
      "products" => $registros,
      "total" => $numeroDeRegistros,
      "page" => $page,
      "itemsPerPage" => $itemsPerPage
    ];
  }
}