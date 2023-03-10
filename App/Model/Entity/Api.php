<?php

use App\Model\Entity\Organization;

    require_once "Organization";

    header("Content-Type: application/json");
    $data = [];

    $fn = $_REQUEST["fn"] ?? null;
    $id = $_REQUEST["id"] ?? 0;
    $name = $_REQUEST["name"] ?? null;
    $site = $_REQUEST["site"] ?? null;
    $description = $_REQUEST["description"] ?? null;
    $sellValue = $_REQUEST["sellValue"] ?? null;
    $productStock = $_REQUEST["productStock"] ?? null;
    $productImage = $_REQUEST["productImage"] ?? null;

    $product1 = new Organization;

    if ($fn === "create" && $name !== null && $site !== null && $description !== null && $sellValue !== null && $productStock !== null && $productImage !== null){
        $product1->setName($name);
        $product1->setSite($site);
        $product1->setDescription($description);
        $product1->setSellValue($sellValue);
        $product1->setProductStock($productStock);
        $product1->setProductImage($productImage);
        $data["product1"] = $product1->create();
    }

    if ($fn === "read"){
        $data["product01"] = $product1->read();
    }

    if ($fn === "update" && $id > 0 && $name !== null && $site !== null && $description !== null && $sellValue !== null && $productStock !== null && $productImage !== null){
        $product1->setName($name);
        $product1->setSite($name);
        $product1->setDescription($name);
        $product1->setSellValue($name);
        $product1->setProductStock($name);
        $product1->setProductImage($name);
        $data["product1"] = $product1->update();
    }

    if ($fn === "delete" && $id > 0){
        $data["product1"] = $product1->delete();
    }

    die(json_encode($data));
?>