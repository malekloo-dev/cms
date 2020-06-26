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

        if (count($data) > 0) {

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
              LEFT JOIN MAS_CLIENT ON MAS_CLIENT.ClientCode=WMS_INVENTORY.ClientCode

              WHERE ";
                //die('1');
                $importSql = " ( WMS_INVENTORY.SKURef1 = '" . $data['extcaseno'] . "'
                 or WMS_INVENTORY.ExtCaseNo ='" . $data['extcaseno'] . "' ) and uom='CNT' and InboundNo not in (110,112)  AND (
              WMS_WO_HR.ordertype in ('IMC' ) )";
                $sql = $sql . $importSql . $orderSql . $limitSql;

                $statusList = DB::select($sql);
                //dd($statusList);

            } else if ($data['status'] == 2) {

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
                $sql = "
                SELECT DISTINCT
            inventoryid,
            ExtCaseNo,
            UnitStatus,
        CASE
		WHEN WMS_INVENTORY.Physical = 1 
		AND Unitstatus = 'FULL' 
		AND wms_inventory.inboundno = '113' THEN
			'Full in Container Yard' 
			WHEN WMS_INVENTORY.Physical = 1 
			AND Unitstatus = 'FULL' 
			AND wms_inventory.inboundno = '459' THEN
				'Full in Container Yard' 
				WHEN Physical = 0 
				AND Unitstatus IN ( 'Empty', 'FULL' ) 
				AND skudate5 IS NOT NULL THEN
					'Loaded on Vessel' 
					WHEN WMS_INVENTORY.Physical = 1 
					AND Unitstatus = 'Full' 
					AND WMS_WO_HR.ordertype = 'IMC' THEN
						'Discharged from Vessel' 
						WHEN Physical = 0 
						AND Unitstatus = 'FULL' 
						AND skudate3 IS NOT NULL THEN
							'Gate Out Full' 
							WHEN WMS_INVENTORY.Physical = 1 
							AND Unitstatus = 'EMPTY' 
							AND WMS_INVENTORY.inboundno IN ( '110', '112' ) THEN
								'Empty in Container Yard' 
								WHEN Physical = 0 
								AND Unitstatus = 'EMPTY' 
								AND skudate3 IS NOT NULL THEN
									'Gate Out Empty' 
									WHEN WMS_INVENTORY.Physical = 1 
									AND Unitstatus = 'EMPTY' 
									AND WMS_INVENTORY.inboundno = '112' THEN
										'Empty in Container Yard' ELSE NULL 
									END AS description,
								CASE
										
										WHEN WMS_INVENTORY.Physical = 1 
										AND Unitstatus = 'FULL' 
										AND wms_inventory.inboundno = '113' THEN
											wms_inventory.Dischargedt 
											WHEN WMS_INVENTORY.Physical = 1 
											AND Unitstatus = 'FULL' 
											AND wms_inventory.inboundno = '459' THEN
												wms_inventory.Dischargedt 
												WHEN Physical = 0 
												AND Unitstatus IN ( 'Empty', 'FULL' ) 
												AND skudate5 IS NOT NULL THEN
													SkuDate5 
													WHEN WMS_INVENTORY.Physical = 1 
													AND Unitstatus = 'Full' 
													AND WMS_WO_HR.ordertype = 'IMC' THEN
														WMS_INVENTORY.Dischargedt 
														WHEN Physical = 0 
														AND Unitstatus = 'FULL' 
														AND skudate3 IS NOT NULL THEN
															skudate3 
															WHEN WMS_INVENTORY.Physical = 1 
															AND Unitstatus = 'EMPTY' 
															AND WMS_INVENTORY.inboundno = '110' THEN
																WMS_INVENTORY.Dischargedt 
																WHEN Physical = 0 
																AND Unitstatus = 'EMPTY' 
																AND skudate3 IS NOT NULL THEN
																	skudate3 
																	WHEN WMS_INVENTORY.Physical = 1 
																	AND Unitstatus = 'EMPTY' 
																	AND WMS_INVENTORY.inboundno = '112' THEN
																		WMS_INVENTORY.Dischargedt ELSE NULL 
																	END AS 'date',
																	VesselDesc,
																	VoyageID 
																FROM
																	WMS_INVENTORY
																	INNER JOIN ( SELECT MAX ( inventoryid ) tr FROM wms_inventory GROUP BY ExtCaseNo ) tt ON wms_inventory.InventoryId= tt.tr
																	INNER JOIN WMS_WO_HR ON (
																	CASE
																			
																			WHEN WMS_INVENTORY.Physical = 1 
																			AND Unitstatus = 'FULL' 
																			AND wms_inventory.inboundno = '113' THEN
																				WMS_INVENTORY.INBWO 
																				WHEN WMS_INVENTORY.Physical = 1 
																				AND Unitstatus = 'FULL' 
																				AND wms_inventory.inboundno = '459' THEN
																					WMS_INVENTORY.INBWO 
																					WHEN WMS_INVENTORY.Physical = 1 
																					AND Unitstatus = 'Full' 
																					AND WMS_WO_HR.ordertype = 'IMC' THEN
																						WMS_INVENTORY.INBWO 
																						WHEN Physical = 0 
																						AND Unitstatus = 'FULL' 
																						AND skudate3 IS NOT NULL THEN
																							wMS_INVENTORY.INBWO 
																							WHEN WMS_INVENTORY.Physical = 1 
																							AND Unitstatus = 'EMPTY' 
																							AND WMS_INVENTORY.inboundno IN ( '110', '112' ) THEN
																								WMS_INVENTORY.INBWO 
																								WHEN Physical = 0 
																								AND Unitstatus = 'EMPTY' 
																								AND skudate3 IS NOT NULL THEN
																									WMS_INVENTORY.INBWO ELSE NULL 
																								END 
																								) = WMS_WO_HR.WONo 
																								OR WMS_INVENTORY.outcono= WMS_WO_HR.CONo
																								INNER JOIN MAS_VESSELS ON MAS_VESSELS.VesselCode= WMS_WO_HR.VesselCode 
																							WHERE
																								WMS_INVENTORY.extcaseno =:extcaseno";
                $statusList = DB::select($sql, array($data['extcaseno']));
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
