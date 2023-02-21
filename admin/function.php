<?php

//Phân quyền
function checkPrivilegeNV(){
    $uri = $_SERVER['REQUEST_URI'];
    $privileges = array(
      "\?page=category$",
      "\?page=category\&id=\d+\&edit=1$",
      "\?page=category\&id=\d+\&del=1$",
      "\?page=list_product$",
      "\?page=list_product\&trang=\d+$",
      "\?page=addproduct$",
      "\?page=editproduct\&id=\d+\&edit=1$",
      "\?page=list_product\&id=\d+\&del=1$",
      "\?page=banner$",
      "\?page=banner\&id=\d+\&edit=1$",
      "\?page=logout$",
    );
    $privileges = implode("|",$privileges);
    preg_match('/' . $privileges . '/', $uri, $matches);
    return !empty($matches);
  }

  function checkPrivilegeNVK(){
    $uri = $_SERVER['REQUEST_URI'];
    $privileges = array(
        
        "\?page=list_pro_ware$",
        "\?page=add_pro_ware$",
        "\?page=ware_printing\&id=\d+$",
        "\?page=edit_pro_ware\&id=\d+\&edit=1$",
        "\?page=list_pro_ware\&id=\d+\&del=1$",
        "\?page=add_pro_export$",
        "\?page=list_pro_ex$",
        "\?page=export_printing\&id=\d+$",
        "\?page=edit_pro_ex\&id=\d+\&edit=1$",
        "\?page=list_pro_ex\&id=\d+\&del=1$",
        "\?page=logout$",
        "\?page=list_product$",
    );
    $privileges = implode("|",$privileges);
    preg_match('/' . $privileges . '/', $uri, $matches);
    return !empty($matches);
  }