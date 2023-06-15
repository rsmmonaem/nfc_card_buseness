<?php $page_name = $this->uri->segment(2);

if ($page_name == "common_user_list") {
    $page_name = "User List";
}
if ($page_name == "create_common_user") {
    $page_name = "Create New";
}
if ($page_name == "unit_head_list") {
    $page_name = "Unit Head List";
}
if ($page_name == "create_unit_head") {
    $page_name = "Create New";
}
if ($page_name == "fao_list") {
    $page_name = "Approval Officer List";
}
if ($page_name == "create_fao") {
    $page_name = "Create New";
}
if ($page_name == "supplier_list") {
    $page_name = "Supplier List";
}
if ($page_name == "create_supplier") {
    $page_name = "Create New";
}
if ($page_name == "inventory_list") {
    $page_name = "Inventory List";
}
if ($page_name == "create_inventory") {
    $page_name = "Stock In";
}
if ($page_name == "stock_check") {
    $page_name = "Stock Check";
}
if ($page_name == "outof_stock_check") {
    $page_name = "Out of Stock Check";
}
if ($page_name == "requisition_list") {
    $page_name = "All Requisition";
}
if ($page_name == "requisition_list_pending") {
    $page_name = "Pending Requisition";
}
if ($page_name == "requisition_list_approved") {
    $page_name = "Approved Requisition";
}
if ($page_name == "requisition_list_reject") {
    $page_name = "Rejected Requisition";
}

?>

<div class="page-content-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <div class="dropdown">
                            <!-- <button class="btn btn-secondary btn-round dropdown-toggle px-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-settings mr-1"></i>Settings
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div> -->
                        </div>
                    </div>
                    <!-- <h4 class="page-title"><?= $page_name = str_replace("_", " ", $page_name); ?></h4> -->
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->