<?php
include("redirect.php");
include("includes/db_lib.php");
include("includes/stats_lib.php");
include("../lang/lang_xml2php.php");
include("barcode/barcode_lib.php");
LangUtil::setPageId("stocks");

$code = explode("$", $_REQUEST['code']);
$lid = $_SESSION['$lab_config_id'];
//echo $code[0]."--".$code[1].'--'.$code[2];
$r_id = $code[0];
$reag = Inventory::getReagentById($lid, $r_id);
$stock = Inventory::getLot($lid, $code[0], $code[2]);
?>
<table id='barcode_search_result_table'  >
	<tbody>
                <tr>
			<td> <?php echo LangUtil::$pageTerms['Reagent']."&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td><td><?php echo $code[1]; ?></td>
		</tr>
		<tr>
			<td> <?php echo LangUtil::$pageTerms['Lot_Number']."&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td><td><?php echo $stock['lot']; ?></td>
		</tr>
                <tr>
                        <td> <?php echo LangUtil::$pageTerms['Quantity']."&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td><td><?php echo Inventory::getLotQuantity($lid, $r_id, $stock['lot']); ?></td>
                </tr>
                <tr>
                        <td><?php echo "Unit"."&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td><td><?php 
                                                                                        $uni = $reag['unit'];
                                                                                            if($uni == '')
                                                                                                echo "units";
                                                                                            else 
                                                                                                echo $uni;
                                                                                            ?></td>
                </tr>
                <tr>
                        <td> <?php echo LangUtil::$pageTerms['Expiry_Date']."&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td><td><?php $dp = explode("-", $stock['expiry_date']);
                                                                                                            $e_date = $dp[2]."/".$dp[1]."/".$dp[0];
                                                                                                            echo $e_date;
                                                                                                        ?></td>
		</tr>
                <tr>
                        <td> <?php echo LangUtil::$pageTerms['Manufacturer']."&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td><td><?php echo $stock['manufacturer']; ?></td>
		</tr>
                <tr>
                        <td> <?php echo LangUtil::$pageTerms['Supplier']."&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td><td><?php echo $stock['supplier']; ?></td>
                </tr>
                <tr>
                        <td> <?php echo "Date of Reception"."&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td><td><?php $dp = explode("-", $stock['date_of_reception']);
                                                                                                    $e_date = $dp[2]."/".$dp[1]."/".$dp[0];
                                                                                                    echo $e_date; ?></td>
                </tr>
                <tr>
                        <td> <?php echo LangUtil::$pageTerms['Remarks']."&nbsp;&nbsp;&nbsp;&nbsp;" ?></td><td><?php echo $stock['remarks']; ?></td>
                </tr>
                <tr>
                        <td><?php echo "Update"."&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td><td><?php echo "<a href='use_stock.php?id=".$reag['id']."&lot=".$stock['lot']."'> Update Stock</a>";
                                                                                            ?></td>
                </tr>
                
	</tbody>