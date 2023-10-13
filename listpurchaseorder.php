<div class="container-fluid mt-4">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Purchase Order</h4>

                <div class="page-title-right">
                    <?php //if($this->rbac->display_operation('materialcategory','addMaterialCategory')){?>
                    <a href="<?php echo base_url();?>purchaseorder/addpurchaseorder" class="btn btn-secondary btn-sm btn-gradient waves-effect waves-light" ><span><i data-feather="plus"></i> Add Purchase Order</span></a>
                    <?php //} ?>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Search Purchase Order</h4>
                    <div class="flex-shrink-0 d-none">
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="live-preview">
                        <form method="post" action="<?php echo base_url();?>Purchaseorder/searchPurchaseorder"  >
                        <div class="row gy-4">
                        <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="invoice_number" class="form-label "> Purchase Invoice Number</label>
                                    <input type="text" class="form-control" id="invoice_number"  name="invoice_number">
                                    <span class="text-danger small" id="invoice_number_error"></span>
                                </div>
                            </div>
                           <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="from_customer" class="form-label ">From Customer</label>
                                    <select class="form-control" name="from_customer" id="from_customer">
                                    <option value="">Select FromCustomer Name</option>
                                    <?php if(!empty($fromcustomer)){ foreach($fromcustomer as $cust_name){?>
                                        <option value="<?php echo $cust_name->id;?>" 
                                            <?php if(isset($fcustomername)){
                                             if($fcustomername==$cust_name->id)
                                                { echo 'selected';}}?>><?php echo $cust_name->CustomerName;?>-<?php echo $cust_name->CustomerCode;?></option>
                                        <?php } } ?>
                                    
                                </select>
                                    
                                    <span class="text-danger small" id="from_customer_error"></span>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="to_customer" class="form-label ">To Customer</label>
                                    <select class="form-control" name="to_customer" id="to_customer">
                                    <option value="">Select FromCustomer Name</option>
                                    <?php if(!empty($to_customer)){ foreach($to_customer as $tocust_name){?>
                                        <option value="<?php echo $tocust_name->id;?>" <?php if(isset($tocustomername)){ if($tocustomername==$tocust_name->id){ echo 'selected';}}?>><?php echo $tocust_name->CustomerName;?>-<?php echo $tocust_name->CustomerCode;?></option>
                                        <?php } } ?>
                                    
                                </select>
                                   
                                    <span class="text-danger small" id="to_customer_error"></span>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="transport_mode" class="form-label ">Transport Mode</label>
                                    <input type="text" class="form-control" id="transport_mode"  name="transport_mode">
                                    <span class="text-danger small" id="transport_mode_error"></span>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="invoice_date" class="form-label ">Invoice Date</label>
                                    <input type="date" class="form-control" id="invoice_date"  name="invoice_date">
                                    <span class="text-danger small" id="invoice_date_error"></span>
                                </div>
                            </div>
                            

                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div>
                                    <label for="po_status" class="form-label">Status</label>
                                    <select class="form-control" name="po_status">
                                        <option value="">--status--</option>
                                        <option value="Draft">Draft</option>
                                        <option value="InProcess">InProcess</option>
                                        <option value="InvoiceProcessed">InvoiceProcessed</option>
                                        
                                    </select>
                                    <span class="text-danger small" id="po_status_error"></span>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-xl-3 col-md-3 col-sm-4">
                                <div class= "mt-4">
                                    <label for="category_name" class="form-label mt-3"></label>
                                    <button type="submit" class="btn btn-success btn-sm search_btn" name="search_purchase_order">Search</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Purchase Oder Details</h4>
                    <div class="flex-shrink-0 d-none">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="hover-rows-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="hover-rows-showcode">
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">Purchase Invoice Number</th>
                                                <th scope="col">From Customer Name</th>
                                                <th scope="col">To Customer Name</th>
                                                <th scope="col">Transport Mode</th>
                                                <th scope="col">Invoice Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($purchase_order)){ foreach($purchase_order as $p){$lmt++; ?>
                                            <tr>
                                                <td><?php echo $lmt;?></td>
                                                <td><?php if(!empty($p->purchaseInvoiceNum)){ echo $p->purchaseInvoiceNum;}?></td>
                                                <td><?php if(!empty($p->fromCustomerName)){ echo $p->fromCustomerName;}?></td>
                                                <td><?php if(!empty($p->toCustomerName)){ echo $p->toCustomerName;}?></td>
                                                <td><?php if(!empty($p->TransportationMode)){ echo $p->TransportationMode;}?></td>
                                                <td><?php if(!empty($p->invoiceDate)){ echo $p->invoiceDate;}?></td>
                                                <td><?php if(!empty($p->status)){ echo $p->status;}?></td>
                                                <td>
                                                <?php if($this->rbac->display_operation('materialcategory','viewMaterialCategory')){?>
                                                    <i class="ri-eye-fill fs-17 lh-1 align-middle"></i>
                                                <?php } ?>
                                                <?php if($this->rbac->display_operation('materialcategory','editMaterialCategory')){?>
                                                    <i class="ri-pencil-fill fs-17 lh-1 align-middle"></i>
                                                <?php } ?>
                                                <?php if($this->rbac->display_operation('materialcategory','deleteMaterialCategory')){?>
                                                    <i class=" ri-delete-bin-fill fs-17 lh-1 align-middle"></i>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } } else{ ?>
                                            <tr>
                                                <td align="center" colspan="4">No Records Found</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                    <nav class="mt-3 d-block">
                                        <?php echo $this->pagination->create_links(); ?>
                                    </nav>
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->
                    </div>
                    
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>

</div>
<!-- container-fluid -->