<table id = "tb_gioLam_bep">
        <tbody>
            <tr>
                <th></th>
                <th>Monday</th>
                <th>Tueday</th>
                <th>Wednesday</th>
                <th>Thurday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
                <th>Tong</th>

            </tr>
<?php
    include "DB_functions_NN.php";
    $date = new Datetime($_GET["Date"]);
    $week = $date->format("W");
    $sql_nv = "
        SELECT Name,ID 
        FROM tb_nhanVien
        Where Role = 'Bep'
            and Status = 1
    ";
    $result_nv = DB_run_query($sql_nv);
    while ($row_nv = $result_nv->fetch_assoc()){
?>
        <tr>
            <td class = "ten_bep">
                <?php echo $row_nv["Name"]; ?>
                <input type ="hidden" name = "nv_Bep_ID" value = "<?php echo $row_nv["ID"]; ?>"
            </td>
            
            <?php 
            $sql_lich = "
                        SELECT d_o_w, ID 
                        FROM tb_Bep
                        WHERE Week = ".$week."
                            and nv_ID = ".$row_nv["ID"]."
            ";
            $result_lich = DB_run_query($sql_lich);
            $row_lich = $result_lich->fetch_assoc();
            if ($row_lich["d_o_w"] != null){
                $arr = str_split($row_lich["d_o_w"]);
            }
            for ($i=0; $i < 7; $i++) {
                
?>
                <td class = "container" id = "lich_bep_<?php echo $row_lich["ID"];  ?>_<?php echo $i;  ?>">      
<?php    
                if ($arr[$i] != null){
                    ?>
                        <div class = "layer_1">
                            <span>
                                <?php
                                switch ($arr[$i]) {
                                    case '1':
                                        echo ("Sang");
                                    break;

                                    case '2':
                                        echo ("Chieu");
                                    break;

                                    case '0':
                                        echo ("OFF");
                                    break;
                                    
                                    
                                }
                                ?>
                            </span>
                        </div>
                        <div class = "overlay">
                            <button onclick ="show_change_BepPage(this,'bep_<?php echo $row_nv["ID"]; ?>_<?php echo $i; ?>')">Change</button>  
                        </div>
                        <div class = "layer_2" id= "bep_<?php echo $row_nv["ID"]; ?>_<?php echo $i; ?>">
                            <select id = "select_ca_lam_<?php echo $row_lich["ID"];  ?>_<?php echo $i;  ?>">
                                <option value = "1">Sang</option>
                                <option value = "2">Chieu</option>
                                <option value = "3">Full</option>
                                <option value = "0">Off</option>
                            </select>
                            <button onclick = "update_lichBep(<?php echo $row_lich["ID"];  ?>,<?php echo $i;  ?>)" class = "">Save</button>
                        </div>
                    <?php
                }else{
                    ?>
                    <button  onclick = "lich_bep_S_C(this,'Shift_bep_<?php echo $row_nv["ID"]; ?>_<?php echo $i; ?>',1)" type = "button" class = "btn_lam btn_">Sang</button>
                    <button  onclick = "lich_bep_S_C(this,'Shift_bep_<?php echo $row_nv["ID"]; ?>_<?php echo $i; ?>',2)" type = "button" class = "btn_lam btn_" >Chieu</button>
                    <input type = "hidden" value = "3" name = "Shift_bep_<?php echo $row_nv["ID"]; ?>" id = "Shift_bep_<?php echo $row_nv["ID"]; ?>_<?php echo $i; ?>">
                    <?php
                }
?>

                </td>
<?php
            }
            ?>
             
        </tr>    
<?php
    }
?>
    <tr>
        <td colspan = "8">
            <?php if ($row_lich["d_o_w"] == null){ ?>
           <button onclick = "save_lichBep()"id = "btn_save_lichBep">Save</button>
            <?php } ?>
        </td>
    </tr>            
    </tbody>
</table>



