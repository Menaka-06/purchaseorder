<?php
class Purchaseorder extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->common_model->check_login();

		$this->load->model("PurchaseOrder_model");	
	}

	public function listPurchaseorder(){
		$data['page_name']='list Purchase order';
		$data['sub_page']='purchaseorder/listpurchaseorder';
		$config['base_url'] = base_url()."purchaseorder/listpurchaseorder"; 
		$config['total_rows'] = $this->common_model->getTotalRecords('tbl_purchase_order','');
		$config['per_page'] = PAGINATION_COUNT; 
		$config=$this->common_model->paginationStyle($config);
		$this->pagination->initialize($config); 
		$lmt=0;
		$lmt=$this->uri->segment(3);
		$data['lmt']=$lmt;
		$data['fromcustomer']=$this->common_model->getActiveCustomer();
		$data['purchase_order'] = $this->PurchaseOrder_model->GetPurchaseorder($config['per_page'],$lmt);
		$this->load->view('user_index',$data);
		
    }
    public function searchPurchaseorder(){
    	$this->common_model->CommentsLog();
    	if(isset($_POST['search_purchase_order'])){
    		$lmt=$invoice_number=$from_customer=$to_customer=$transport_mode=$invoice_date=$po_status="";
    		$invoice_number=$this->security->xss_clean($this->input->post('invoice_number'));
    		$from_customer=$this->security->xss_clean($this->input->post('from_customer'));
    		$to_customer=$this->security->xss_clean($this->input->post('to_customer'));
    		$transport_mode=$this->security->xss_clean($this->input->post('transport_mode'));
    		$invoice_date=$this->security->xss_clean($this->input->post('invoice_date'));
    		$po_status=$this->security->xss_clean($this->input->post('po_status'));
    		if(empty($invoice_number)){
    							
				$invoice_number=$this->input->get('invoice_number');
				if(!empty($invoice_number)){
					$invoice_number=$this->common_model->decode($invoice_number);
				}
			}
			if(empty($from_customer)){
				
				$from_customer=$this->input->get('from_customer');
				if(!empty($from_customer)){
					$from_customer=$this->common_model->decode($from_customer);
				}
			}
			if(empty($to_customer)){
				
				$to_customer=$this->input->get('to_customer');
				if(!empty($to_customer)){
					$to_customer=$this->common_model->decode($to_customer);
				}
			}
			if(empty($transport_mode)){
				
				$transport_mode=$this->input->get('transport_mode');
				if(!empty($transport_mode)){
					$transport_mode=$this->common_model->decode($transport_mode);
				}
			}
			if(empty($invoice_date)){
				
				$invoice_date=$this->input->get('invoice_date');
				if(!empty($invoice_date)){
					$invoice_date=date('Y-m-d',$invoice_date);
				}
			}
			if(empty($po_status)){
				
				$po_status=$this->input->get('po_status');
				if(!empty($po_status)){
					$po_status=$this->common_model->decode($po_status);
				}
			}
			if($lmt==""){
				$lmt=$this->input->get('lmt');
			}
			$encoded_invoice_number=$encoded_from_customer=$encoded_to_customer=$encoded_transport_mode=$encoded_invoice_date=$encoded_po_status="";

			if(!empty($invoice_number)){$encoded_invoice_number=$this->common_model->encode($invoice_number);}
			if(!empty($from_customer)){$encoded_from_customer=$this->common_model->encode($from_customer);}
			if(!empty($to_customer)){$encoded_to_customer=$this->common_model->encode($to_customer);}
			if(!empty($transport_mode)){$encoded_transport_mode=$this->common_model->encode($transport_mode);}
			if(!empty($invoice_date)){$encoded_invoice_date=strtotime($invoice_date);;}
			if(!empty($po_status)){$encoded_po_status=$this->common_model->encode($po_status);}
			
			if(!empty($invoice_number)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number));
			}
			if(!empty($from_customer)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?from_customer=".$encoded_from_customer.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('fromCustomerName'=>$from_customer));
			}
			if(!empty($transport_mode)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?transport_mode=".$encoded_transport_mode.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('TransportationMode'=>$transport_mode));
			}
			if(!empty($invoice_date)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_date=".$encoded_invoice_date.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('invoiceDate'=>$transport_mode));
			}
			if(!empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?po_status=".$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('status'=>$po_status));
			}
			if(!empty($invoice_number)& !empty($from_customer)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&from_customer='.$encoded_from_customer.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'fromCustomerName'=>$from_customer));
			}
			if(!empty($invoice_number)& !empty($transport_mode)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&transport_mode='.$encoded_transport_mode.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'TransportationMode'=>$transport_mode));
			}
			if(!empty($invoice_number)& !empty($invoice_date)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&invoice_date='.$encoded_invoice_date.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'invoiceDate'=>$invoice_date));
			}
			if(!empty($invoice_number)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'status'=>$po_status));
			}
			if(!empty($from_customer)& !empty($transport_mode)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?from_customer=".$encoded_from_customer.'&transport_mode='.$encoded_transport_mode.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('fromCustomerName'=>$from_customer,'TransportationMode'=>$transport_mode));
			}
			if(!empty($from_customer)& !empty($invoice_date)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?from_customer=".$encoded_from_customer.'&invoice_date='.$encoded_invoice_date.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('fromCustomerName'=>$from_customer,'invoiceDate'=>$invoice_date));
			}
			if(!empty($from_customer)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?from_customer=".$encoded_from_customer.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('fromCustomerName'=>$from_customer,'status'=>$po_status));
			}
			if(!empty($transport_mode)& !empty($invoice_date)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?transport_mode=".$encoded_transport_mode.'&invoice_date='.$encoded_invoice_date.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('TransportationMode'=>$transport_mode,'invoiceDate'=>$invoice_date));
			}
			if(!empty($transport_mode)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?transport_mode=".$encoded_transport_mode.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('TransportationMode'=>$transport_mode,'status'=>$po_status));
			}
			if(!empty($invoice_number)& !empty($from_customer)& !empty($transport_mode)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&from_customer='.$encoded_from_customer.'&transport_mode='.$encoded_transport_mode.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'fromCustomerName'=>$from_customer,'TransportationMode'=>$transport_mode));
			}
			if(!empty($invoice_number)& !empty($from_customer)& !empty($invoice_date)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&from_customer='.$encoded_from_customer.'&invoice_date='.$encoded_invoice_date.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'fromCustomerName'=>$from_customer,'invoiceDate'=>$invoice_date));
			}
			if(!empty($invoice_number)& !empty($from_customer)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&from_customer='.$encoded_from_customer.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'fromCustomerName'=>$from_customer,'status'=>$po_status));
			}
			if(!empty($invoice_number)& !empty($transport_mode)& !empty($invoice_date)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&transport_mode='.$encoded_transport_mode.'&invoice_date='.$encoded_invoice_date.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'TransportationMode'=>$transport_mode,'invoiceDate'=>$invoice_date));
			}
			if(!empty($invoice_number)& !empty($transport_mode)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&transport_mode='.$encoded_transport_mode.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'TransportationMode'=>$transport_mode,'status'=>$po_status));
			}
			if(!empty($invoice_number)& !empty($invoice_date)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&invoice_date='.$encoded_invoice_date.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'invoiceDate'=>$invoice_date,'status'=>$po_status));
			}
			if(!empty($from_customer)& !empty($transport_mode)& !empty($invoice_date)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?from_customer=".$encoded_from_customer.'&transport_mode='.$encoded_transport_mode.'&invoice_date='.$encoded_invoice_date.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('fromCustomerName'=>$from_customer,'TransportationMode'=>$transport_mode,'invoiceDate'=>$invoice_date));
			}
			if(!empty($from_customer)& !empty($transport_mode)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?from_customer=".$encoded_from_customer.'&transport_mode='.$encoded_transport_mode.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('fromCustomerName'=>$from_customer,'TransportationMode'=>$transport_mode,'status'=>$po_status));
			}
			if(!empty($from_customer)& !empty($invoice_date)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?from_customer=".$encoded_from_customer.'&invoice_date='.$encoded_invoice_date.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('fromCustomerName'=>$from_customer,'invoiceDate'=>$invoice_date,'status'=>$po_status));
			}
			if(!empty($invoice_number)& !empty($from_customer)& !empty($transport_mode)& !empty($invoice_date)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&from_customer='.$encoded_from_customer.'&transport_mode='.$encoded_transport_mode.'&invoice_date='.$encoded_invoice_date.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'fromCustomerName'=>$from_customer,'TransportationMode'=>$transport_mode,'invoiceDate'=>$invoice_date));
			}
			if(!empty($invoice_number)& !empty($from_customer)& !empty($transport_mode)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&from_customer='.$encoded_from_customer.'&transport_mode='.$encoded_transport_mode.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'fromCustomerName'=>$from_customer,'TransportationMode'=>$transport_mode,'status'=>$po_status));
			}
			if(!empty($invoice_number)& !empty($from_customer)& !empty($invoice_date)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&from_customer='.$encoded_from_customer.'&invoice_date='.$encoded_invoice_date.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'fromCustomerName'=>$from_customer,'invoiceDate'=>$invoice_date,'status'=>$po_status));
			}
			if(!empty($from_customer)& !empty($transport_mode)& !empty($invoice_date)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?from_customer=".$encoded_from_customer.'&transport_mode='.$encoded_transport_mode.'&invoice_date='.$encoded_invoice_date.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('fromCustomerName'=>$from_customer,'TransportationMode'=>$transport_mode,'invoiceDate'=>$invoice_date,'status'=>$po_status));
			}
			if(!empty($invoice_number)& !empty($transport_mode)& !empty($invoice_date)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&transport_mode='.$encoded_transport_mode.'&invoice_date='.$encoded_invoice_date.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'TransportationMode'=>$transport_mode,'invoiceDate'=>$invoice_date,'status'=>$po_status));
			}
			if(!empty($invoice_number)& !empty($from_customer)& !empty($transport_mode)& !empty($invoice_date)& !empty($po_status)){
				$config['base_url']=base_url()."purchaseorder/searchPurchaseorder?invoice_number=".$encoded_invoice_number.'&from_customer='.$encoded_from_customer.'&transport_mode='.$encoded_transport_mode.'&invoice_date='.$encoded_invoice_date.'&po_status='.$encoded_po_status.$lmt;
				$config['total_rows']=$this->common_model->getTotalRecords('tbl_purchase_order',array('purchaseInvoiceNum'=>$invoice_number,'fromCustomerName'=>$from_customer,'TransportationMode'=>$transport_mode,'invoiceDate'=>$invoice_date,'status'=>$po_status));
			}


    			$data['page_name']='Search Purchase order';
				$data['sub_page']='purchaseorder/listpurchaseorder';
				$config['per_page'] = PAGINATION_COUNT; 
				$config=$this->common_model->paginationStyle($config);
				$this->pagination->initialize($config); 
				$config['total_rows'] = $this->common_model->getTotalRecords('tbl_purchase_order','');
				$data['fromcustomer']=$this->common_model->getActiveCustomer();
				$data['lmt']=$lmt;
				$data['invoice_number']=$invoice_number;
				$data['fcustomername']=$from_customer;
				$data['transport_mode']=$transport_mode;
				$data['invoice_date']=$invoice_date;
				$data['po_status']=$po_status;
				$data['purchase_order'] = $this->PurchaseOrder_model->GetPurchaseorderList($config['per_page'],$lmt,$invoice_number,$from_customer,$transport_mode,$invoice_date,$po_status);
				$this->load->view('user_index',$data);
		
    }}


  	public function addPurchaseorder(){
		$data['page_name']='Add purchase order';
		$data['sub_page']='purchaseorder/Addpurchaseorder';
		$this->load->view('user_index',$data);
    }

	public function orderReturns(){
		$data['page_name']='Order Returns';
		$data['sub_page']='purchaseorder/Orderreturns';
		$this->load->view('user_index',$data);
    }

	public function addOrderReturns(){
		$data['page_name']='Add Order Returns';
		$data['sub_page']='purchaseorder/Addorderreturns';
		$this->load->view('user_index',$data);
    }

	public function purchaseInvoice(){
		$data['page_name']='Purchase Invoice';
		$data['sub_page']='purchaseorder/PurchaseInvoice';
		$this->load->view('user_index',$data);
    }
	public function addPurchaseInvoice(){
		$data['page_name']='Add Purchase Invoice';
		$data['sub_page']='purchaseorder/AddPurchaseInvoice';
		$this->load->view('user_index',$data);
    }

	public function debitNote(){
		$data['page_name']='Debit Note';
		$data['sub_page']='purchaseorder/Debitnote';
		$this->load->view('user_index',$data);
    }
	public function addDebitNote(){
		$data['page_name']='Add Debit Note';
		$data['sub_page']='purchaseorder/AdddebitNote';
		$this->load->view('user_index',$data);
    }
	public function purchaseReports(){
		$data['page_name']='Purchase Reports';
		$data['sub_page']='purchaseorder/PurchaseReports';
		$this->load->view('user_index',$data);
    }
	public function purchaseSettings(){
		$data['page_name']='Purchase Settings';
		$data['sub_page']='purchaseorder/PurchaseSettings';
		$this->load->view('user_index',$data);
    }

}