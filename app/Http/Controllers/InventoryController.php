<?php

namespace App\Http\Controllers;

use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WMS_INVENTORY;
use Illuminate\Support\Facades\DB;


class InventoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //Auth::loginUsingId(1);
        //$this->middleware('auth');
    }

    public function exportEmpty($baseSql)
    {

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $data = $request->all();

        $statusList = array();
        $vessel = array();
        $shipping_name = '';
        $isSearch = 0;

        if (count($data) > 0 and trim($data['extcaseno']) != '') {

            $isSearch = 1;

            $statusList = array();
            $vessel = array();
            $shipping_name = '';

            $orderSql = "
            ORDER BY
                WMS_INVENTORY.InventoryId ASC
            ";
            $limitSql = "
               OFFSET 0 ROWS
               FETCH NEXT 10 ROWS ONLY
            ";
            $limitSql = "";
            if ($data['status'] == 1) {
                $sql = "SELECT
                    InboundNo,
                    VesselDesc,
                    VoyageID,
                    ClientName,
                    WMS_INVENTORY.SKURef1 AS bl_bumber,
                    WMS_INVENTORY.extcaseno,
                	WMS_INVENTORY.InventoryId,
                    WMS_INVENTORY.SkuDate3 AS gate_out_date,
                    WMS_WO_HR.ordertype,
                    WMS_INVENTORY.SkuDate4 AS stripping_date,
                    WMS_INVENTORY.ClientCode AS shipping_line,
                    WMS_INVENTORY.SkuCode AS sz_tp,
                    WMS_INVENTORY.ConsigneeNameDL,
                    WMS_INVENTORY.DischargeDt,
                    WMS_INVENTORY.LocationCode,
                    WMS_INVENTORY.UnitStatus,
                    WMS_WO_HR.WONo ,
                    WMS_INVENTORY.CurrentWO ,
                    WMS_INVENTORY.SkuDate2,
                    WMS_INVENTORY.SkuDate6,
                    WMS_INVENTORY.SkuDate1 
              FROM
                 WMS_INVENTORY
               INNER JOIN WMS_WO_HR ON WMS_INVENTORY.INBWO= WMS_WO_HR.WONo 
                inner join  MAS_VESSELS on MAS_VESSELS.VesselCode=WMS_WO_HR.VesselCode
                INNER JOIN MAS_CLIENT ON WMS_INVENTORY.ClientCode=MAS_CLIENT.ClientCode

              WHERE ";
                //die('1');
                $importSql = " ( WMS_INVENTORY.ExtCaseNo ='" . $data['extcaseno'] . "' 
                 or WMS_INVENTORY.skuref1='" . $data['extcaseno'] . "' ) 
                 and uom='CNT' and InboundNo not in (110,112)  
                 AND ( WMS_WO_HR.ordertype in ('IMC' ) )
                
                 ";
                $orderSql = "ORDER BY
                                    WMS_INVENTORY.InventoryId DESC ";
                $sql = $sql . $importSql . $orderSql . $limitSql;

                $statusList = DB::select($sql);
                //dd($statusList);

            } else if ($data['status'] == 2) {

                $sql = "SELECT
	                InboundNo
                    VoyageID,
                    WMS_INVENTORY.extcaseno,
	                WMS_INVENTORY.SkuCode AS sz_tp,
	                WMS_INVENTORY.DischargeDt,
                    WMS_INVENTORY.SkuDate3 AS gate_out_date,
                    ClientName,
                    WMS_INVENTORY.SKURef1 AS bl_bumber,
                	WMS_INVENTORY.InventoryId,
                    WMS_INVENTORY.SkuDate4 AS stripping_date,
                    WMS_INVENTORY.ClientCode AS shipping_line,
                    WMS_INVENTORY.ConsigneeNameDL,
                    WMS_INVENTORY.LocationCode,
                    WMS_INVENTORY.UnitStatus,
                    WMS_INVENTORY.CurrentWO ,
                    WMS_INVENTORY.SkuDate2,
                    WMS_INVENTORY.SkuDate6,
                    WMS_INVENTORY.SkuDate1 

              FROM
                 WMS_INVENTORY
              LEFT JOIN MAS_CLIENT ON MAS_CLIENT.ClientCode=WMS_INVENTORY.ClientCode
              WHERE ";
                $exportSql1 = " WMS_INVENTORY.extcaseno = '" . $data['extcaseno'] . "'
                and uom='CNT' and InboundNo  in (110,112)  ";
                $sql = $sql . $exportSql1 . $orderSql . $limitSql;

                $statusList = DB::select($sql);


            } else if ($data['status'] == 3) {

                $sql = "SELECT
                    InboundNo,
                    ClientName,
                    WMS_INVENTORY.SKURef1 AS bl_bumber,
                    WMS_INVENTORY.extcaseno,
                	WMS_INVENTORY.InventoryId,
                    WMS_INVENTORY.SkuDate3 AS gate_out_date,
                    WMS_INVENTORY.SkuDate4 AS stripping_date,
                    WMS_INVENTORY.ClientCode AS shipping_line,
                    WMS_INVENTORY.SkuCode AS sz_tp,
                    WMS_INVENTORY.ConsigneeNameDL,
                    WMS_INVENTORY.DischargeDt,
                    WMS_INVENTORY.LocationCode,
                    WMS_INVENTORY.UnitStatus,
                    WMS_INVENTORY.CurrentWO ,
                    WMS_INVENTORY.SkuDate2,
                    WMS_INVENTORY.SkuDate6,
                    WMS_INVENTORY.SkuDate1 
              FROM
                 WMS_INVENTORY
              LEFT JOIN MAS_CLIENT ON MAS_CLIENT.ClientCode=WMS_INVENTORY.ClientCode
              WHERE ";
                $exportSql2 = " WMS_INVENTORY.extcaseno = '" . $data['extcaseno'] . "'  and uom='CNT' and InboundNo  in (459,118) ";

                $sql = $sql . $exportSql2 . $orderSql . $limitSql;
                //die($sql);
                $statusList = DB::select($sql);


            } else if ($data['status'] == 4) {
                $sql = "SELECT distinct  WMS_INVENTORY.SkuCode AS sz_tp,
                ExtCaseNo,UnitStatus,skuref1,
                case 
                when Physical =1 and ordertype='IMC' and (unitstatus = 'FULL' or UnitStatus='EMPTY') and WMS_INVENTORY.inboundno not in( '110','112') then 'Discharged from Vessel' 
                when Physical =0 and ordertype='IMC' and unitstatus = 'FULL' and WMS_INVENTORY.inboundno not in( '110','112') and skudate3 is not null then 'Gate Out Full'
                when Physical =0 and ordertype='IMC' and unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno not in( '110','112')and skudate3 is not null then 'Gate Out Empty'
                when Physical = 0 and Unitstatus = 'EMPTY'  and WMS_INVENTORY.inboundno  ='110'and skudate3 is not null then 'Gate Out Empty' 
                when Physical = 0 and Unitstatus = 'EMPTY'  and WMS_INVENTORY.inboundno  ='112'and skudate3 is not null then 'Gate Out Empty' 
                when Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno = '110'and skudate5 is null then 'Empty in Container Yard'
                when Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno = '112' and skudate5 is  null then 'Empty in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '118' then 'Full in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '459' then 'Full in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '467' then 'Full Return'
                when Physical = 0 and Unitstatus in( 'Empty','FULL') and skudate5 is not null and outcono is not null then 'Loaded on Vessel' 
                when Physical = 1 and Unitstatus in( 'Empty','FULL') and skudate5 is not null and outcono is not null then 'Loaded on Vessel'
                 else null end as description,
                case
                when Physical =1 and ordertype='IMC' and (unitstatus = 'FULL' or UnitStatus='EMPTY') and WMS_INVENTORY.inboundno not in( '110','112') then wms_inventory.DischargeDt--'Discharged from Vessel' 
                when Physical =0 and ordertype='IMC' and unitstatus = 'FULL' and WMS_INVENTORY.inboundno not in( '110','112') and skudate3 is not null then wms_inventory.skudate3--'Gate Out Full'
                when Physical =0 and ordertype='IMC' and unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno not in( '110','112')and skudate3 is not null then wms_inventory.skudate3--'Gate Out Empty'
                when Physical = 0 and Unitstatus = 'EMPTY'  and WMS_INVENTORY.inboundno= '110'and skudate3 is not null then wms_inventory.skudate3--'Gate Out Empty'
                when Physical = 0 and Unitstatus = 'EMPTY'  and WMS_INVENTORY.inboundno= '112'and skudate3 is not null then wms_inventory.skudate3--'Gate Out Empty'  
                when Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno = '110'and skudate5 is  null then WMS_INVENTORY.Dischargedt--'Empty in Container Yard'
                when Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno = '112'and skudate5 is  null then WMS_INVENTORY.Dischargedt--'Empty in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '118' then wms_inventory.Dischargedt--'Full in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '459' then wms_inventory.Dischargedt--'Full in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '467' then wms_inventory.Dischargedt-- 'Full Return'
                when Physical = 0 and Unitstatus in( 'Empty','FULL') and skudate5 is not null and outcono is not null then wms_inventory.skudate5--'Loaded on Vessel' 
                when Physical = 1 and Unitstatus in( 'Empty','FULL') and skudate5 is not null and outcono is not null then wms_inventory.skudate5--'Loaded on Vessel'
                 else null end as date ,
                 case
                when Physical =1 and ordertype='IMC' and (unitstatus = 'FULL' or UnitStatus='EMPTY') and WMS_INVENTORY.inboundno not in( '110','112') then VesselDesc--'Discharged from Vessel' 
                when Physical =0 and ordertype='IMC' and unitstatus = 'FULL' and WMS_INVENTORY.inboundno not in( '110','112') and skudate3 is not null then VesselDesc--'Gate Out Full'
                when Physical =0 and ordertype='IMC' and unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno not in( '110','112')and skudate3 is not null then VesselDesc--'Gate Out Empty'
                when Physical = 0 and Unitstatus = 'EMPTY'  and WMS_INVENTORY.inboundno='110'and skudate3 is not null then '-'--'Gate Out Empty'
                when Physical = 0 and Unitstatus = 'EMPTY'  and WMS_INVENTORY.inboundno='112'and skudate3 is not null then '-'--'Gate Out Empty'  
                when Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno = '110'and skudate5 is  null then '-'--'Empty in Container Yard'
                when Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno = '112'and skudate5 is  null then '-'--'Empty in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '118' then '-'--'Full in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '459' then '-'--'Full in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '467' then '-' --'Full Return--
                when Physical = 0 and Unitstatus in( 'Empty','FULL') and skudate5 is not null and outcono is not null  then VesselDesc--'Loaded on Vessel' 
                when Physical = 1 and Unitstatus in( 'Empty','FULL') and skudate5 is not null and outcono is not null  then VesselDesc--'Loaded on Vessel'
                 else null end as vesseldescription,
                 case
                when Physical =1 and ordertype='IMC' and (unitstatus = 'FULL' or UnitStatus='EMPTY') and WMS_INVENTORY.inboundno not in( '110','112') then VoyageID--'Discharged from Vessel' 
                when Physical =0 and ordertype='IMC' and unitstatus = 'FULL' and WMS_INVENTORY.inboundno not in( '110','112') and skudate3 is not null then VoyageID--'Gate Out Full'
                when Physical =0 and ordertype='IMC' and unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno not in( '110','112')and skudate3 is not null then VoyageID--'Gate Out Empty'
                when Physical = 0 and Unitstatus = 'EMPTY'  and WMS_INVENTORY.inboundno='110'and skudate3 is not null then '-'--'Gate Out Empty'
                when Physical = 0 and Unitstatus = 'EMPTY'  and WMS_INVENTORY.inboundno='112'and skudate3 is not null then '-'--'Gate Out Empty' 
                when Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno = '110'and skudate5 is  null then '-'--'Empty in Container Yard'
                when Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno = '112'and skudate5 is  null then '-'--'Empty in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '118' then '-'--'Full in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '459' then '-'--'Full in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '467' then '-' --'Full Return--
                when Physical = 0 and Unitstatus in( 'Empty','FULL') and skudate5 is not null and outcono is not null  then VoyageID--'Loaded on Vessel' 
                when Physical = 1 and Unitstatus in( 'Empty','FULL') and skudate5 is not null and outcono is not null  then VoyageID--'Loaded on Vessel'
                 else null end as VoyageID
                from wms_inventory
                 inner join
                 (select max (inventoryid)tr  from wms_inventory group by ExtCaseNo) tt
                                on wms_inventory.InventoryId=tt.tr
                 inner join WMS_WO_HR ON ( case
                when Physical =1 and ordertype='IMC' and (unitstatus = 'FULL' or UnitStatus='EMPTY') and WMS_INVENTORY.inboundno not in( '110','112') then WMS_INVENTORY.INBWO --'Discharged from Vessel' 
                when Physical =0 and ordertype='IMC' and unitstatus = 'FULL' and WMS_INVENTORY.inboundno not in( '110','112') and skudate3 is not null then WMS_INVENTORY.INBWO --'Gate Out Full'
                when Physical =0 and ordertype='IMC' and unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno not in( '110','112')and skudate3 is not null then WMS_INVENTORY.INBWO --'Gate Out Empty'
                when Physical = 0 and Unitstatus = 'EMPTY'  and WMS_INVENTORY.inboundno ='110'and skudate3 is not null then WMS_INVENTORY.INBWO --'Gate Out Empty' 
                when Physical = 0 and Unitstatus = 'EMPTY'  and WMS_INVENTORY.inboundno ='112'and skudate3 is not null then WMS_INVENTORY.INBWO --'Gate Out Empty' 
                when Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno = '110' and skudate5 is  null then WMS_INVENTORY.INBWO --'Empty in Container Yard'
                when Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno = '112'and skudate5 is  null then WMS_INVENTORY.INBWO --'Empty in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '118' then WMS_INVENTORY.INBWO --'Full in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '459' then WMS_INVENTORY.INBWO --'Full in Container Yard'
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '467' then WMS_INVENTORY.INBWO --'Full Return--
                else null end)= WMS_WO_HR.WONo or 
                        WMS_INVENTORY.outcono= WMS_WO_HR.CONo 
                         
                          inner join  MAS_VESSELS on (case 
                         when WMS_INVENTORY.Physical = 1 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno= '112'and skudate5 is  null then 'EMTR'
                         when WMS_INVENTORY.Physical = 0 and Unitstatus = 'EMPTY' and WMS_INVENTORY.inboundno= '112'and skudate5 is  null then 'EMTR'
                         when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '118' then 'EMTR' --'Full in Container Yard'
                         when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '459' then 'EMTR' --'Full in Container Yard' 
                when  WMS_INVENTORY.Physical = 1 and Unitstatus = 'FULL' and wms_inventory.inboundno = '467' then 'EMTR' --'Full Return--
                         else WMS_WO_HR.VesselCode end)=MAS_VESSELS.VesselCode  
                         
                  
                 
                WHERE
                
                ( WMS_INVENTORY.ExtCaseNo ='" . $data['extcaseno'] . "' 
                or WMS_INVENTORY.skuref1='" . $data['extcaseno'] . "' ) ";

                $statusList = DB::select($sql);
                //dd($statusList);

            } else {
                die('Not Found');
            }

            //die($sql);

        }

        //dd($statusList);
        //$result= WMS_INVENTORY::where('InventoryId','=','937120')->get();

        return view('bmt.Inventory', compact(['data', 'statusList', 'vessel', 'shipping_name', 'isSearch']));

    }

    public function index1(Request $request)
    {


        $data = $request->all();

        $statusList = array();
        $vessel = array();
        $shipping_name = '';
        $isSearch = 0;

        if (count($data) > 0) {

            $isSearch = 1;

            $statusList = array();
            $vessel = array();
            $shipping_name = '';


            ////////////////
            //$bl_bumberList
            $sql = "SELECT
                    WMS_INVENTORY.SKURef1 AS bl_bumber,
                    WMS_INVENTORY.extcaseno,
                	WMS_INVENTORY.InventoryId
              FROM
                 WMS_INVENTORY
              
              WHERE
               
                WMS_INVENTORY.SKURef1 = '" . $data['extcaseno'] . "'";
            //WMS_INVENTORY.extcaseno = '".$data['extcaseno']."'";


            $orderSql = "
            ORDER BY
                WMS_INVENTORY.InventoryId DESC
            ";
            $limitSql = "
               OFFSET 0 ROWS
               FETCH NEXT 1 ROWS ONLY
            ";


            if ($data['status'] == 1) {
                $this->exportEmpty();
                $sql = $sql . $orderSql . $limitSql;

            } else if ($data['status'] == -1) {
                $sql = $sql . $orderSql . $limitSql;

            } else {
                die('Not Found');
            }

            $bl_bumberList = DB::select($sql);

            if (count($bl_bumberList)) {
                $extcaseno = $bl_bumberList[0]->extcaseno;
            } else {
                $extcaseno = $data['extcaseno'];

            }

            $sql = "SELECT
                    InboundNo,
                    VesselDesc,
                    WMS_INVENTORY.SKURef1 AS bl_bumber,
                    WMS_INVENTORY.extcaseno,
                	WMS_INVENTORY.InventoryId,
                    WMS_INVENTORY.SkuDate3 AS gate_out_date,
                    WMS_WO_HR.ordertype,
                    WMS_INVENTORY.SkuDate4 AS stripping_date,
                    WMS_INVENTORY.ClientCode AS shipping_line,
                    WMS_INVENTORY.SkuCode AS sz_tp,
                    WMS_INVENTORY.ConsigneeNameDL,
                    WMS_INVENTORY.DischargeDt,
                    WMS_INVENTORY.LocationCode,
                    WMS_INVENTORY.UnitStatus,
                    WMS_WO_HR.WONo ,
                    WMS_INVENTORY.CurrentWO ,
                    WMS_INVENTORY.SkuDate2,
                    WMS_INVENTORY.SkuDate6,
                    WMS_INVENTORY.SkuDate1 
              FROM
                 WMS_INVENTORY
              INNER JOIN WMS_WO_HR ON WMS_INVENTORY.CurrentWO= WMS_WO_HR.WONo 
              WHERE            
              WMS_INVENTORY.extcaseno = '" . $extcaseno . "'";
            $exportSql1 = "uom='CNT' and InboundNo  in (110,112)";

            /*$exportSql1 =
                "
                and (
                    WMS_WO_HR.ordertype='MTR'
                    OR
                    WMS_WO_HR.ordertype='STR'
                    OR
                    WMS_WO_HR.ordertype='FXP'
                    OR
                    WMS_WO_HR.ordertype='STF'
                     OR
                    WMS_WO_HR.ordertype='RLS'

                )";*/
            $exportSql2 = '';

            $importSql =
                "
                and (
                    WMS_WO_HR.ordertype='IMC'
                )";

            $orderSql = "
            ORDER BY
                WMS_INVENTORY.InventoryId DESC
            ";
            $limitSql = "
               OFFSET 0 ROWS
               FETCH NEXT 1 ROWS ONLY
            ";
            $limitSql = '';


            if ($data['status'] == 1) {
                $sql = $sql . $importSql . $orderSql . $limitSql;

            } else if ($data['status'] == 2) {
                $sql = $sql . $exportSql1 . $orderSql . $limitSql;

            } else if ($data['status'] == 3) {
                $sql = $sql . $exportSql2 . $orderSql . $limitSql;

            } else {
                die('Not Found');
            }
            //die($sql);

            $statusList = DB::select($sql);


            if (isset($statusList[0])) {

                $shippingLineCode = $statusList[0]->shipping_line;
                $shippingLineSql = "
                    SELECT
                        ClientName,
                        ClientCode
                    FROM
                        MAS_CLIENT
                    WHERE
                        ClientCode = '" . $shippingLineCode . "' ";

                // print_r($statusList);'

                $shipping = DB::select($shippingLineSql);
                $shipping_name = '';
                if (count($shipping)) {
                    $shipping_name = $shipping[0]->ClientName;
                }


                $inventoryId = $statusList[0]->InventoryId;
                $vesselSql = "
                    SELECT
                        VesselDesc,
                        VoyageID,
                        WMS_INVENTORY.InventoryId
                    FROM
                        MAS_VESSELS
                        INNER JOIN WMS_INB_HR ON MAS_VESSELS.VesselCode= WMS_INB_HR.VesselCode
                        INNER JOIN wms_inventory ON wms_inventory.InboundNo= WMS_INB_HR.InboundNo 
                    WHERE
                        extcaseno = '" . $data['extcaseno'] . "' and WMS_INVENTORY.InventoryId='" . $inventoryId . "'";

                // print_r($statusList);'

                $vessel = DB::select($vesselSql);
            }


        }

        //dd($statusList);
        //$result= WMS_INVENTORY::where('InventoryId','=','937120')->get();

        return view('bmt.Inventory', compact(['data', 'statusList', 'vessel', 'shipping_name', 'isSearch']));

    }
}
