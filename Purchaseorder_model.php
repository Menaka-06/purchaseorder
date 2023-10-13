<?php 
class Purchaseorder_model extends CI_Model{

	 public function __construct(){
        parent::__construct();
    }
    public function GetPurchaseorder($limit,$start){
        $this->db->select('*')->from('tbl_purchase_order');
        $this->db->limit($limit,$start);
        $this->db->order_by('id','desc');
        return $this->db->get()->result();

    }
    public function getCustomerName(){

    $this->db->select('*')->from('tbl_purchase_order');
    $res=$this->db->get()->result();
        return $res;

    }
    public function GetPurchaseorderList($limit,$start,$invoice_number,$from_customer,$transport_mode,$invoice_date,$po_status){
        $this->db->select('*')->from('tbl_purchase_order');
        if(!empty($invoice_number)){
            $this->db->where('purchaseInvoiceNum',$invoice_number);
        }
        if(!empty($from_customer)){
            $this->db->where('fromCustomerName',$from_customer);
        }
        if(!empty($transport_mode)){
            $this->db->where('TransportationMode',$transport_mode);
        }
        if(!empty($invoice_date)){
            $this->db->where('invoiceDate',$invoice_date);
        }
        if(!empty($po_status)){
            $this->db->where('status',$po_status);
        }

        $this->db->limit($limit,$start);
        $this->db->order_by('id','desc');
        $res=$this->db->get()->result();
        return $res;

    }

}

?>