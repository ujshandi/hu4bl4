	<script  type="text/javascript" >
		$(function(){
			var url;
			
			clearFilter<?=$objectId;?> = function (){
				$("#filter_tahun<?=$objectId;?>").val('');
				$("#unit<?=$objectId;?>").val('');
				$("#filter_e1<?=$objectId;?>").val('');
				$("#filter_e2<?=$objectId;?>").val('');
				searchData<?=$objectId;?>();
			}
			
			
			//tipe 1=grid, 2=pdf, 3=excel
			getUrl<?=$objectId;?> = function (tipe){
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
				var file1 = $("#filter_e1<?=$objectId;?>").val();
				var file2 = $("#filter_e2<?=$objectId;?>").val();
				var unit = $("#unit<?=$objectId;?>").val();
				
				filtahun = (filtahun=="")?"-1":filtahun;
				
				if (tipe==1){
					return "<?=base_url()?>utility/login_log/grid/"+filtahun+"/"+file1+"/"+file2;
				}
				else if (tipe==2){
					return "<?=base_url()?>utility/login_log/pdf/"+filtahun+"/"+file1+"/"+file2;
				}else if (tipe==3){
					return "<?=base_url()?>utility/login_log/excel/"+filtahun+"/"+file1+"/"+file2;
				}
			}
			
			
			searchData<?=$objectId;?> = function (){
				url = getUrl<?=$objectId;?>(1);
				
				
				$('#dg<?=$objectId;?>').datagrid({
					url:url					
				});
			}
			//end searhData 
			
			printData<?=$objectId;?>=function(){	
				//$.jqURL.loc(getUrl<?=$objectId;?>(2),{w:800,h:600,wintype:"_blank"});
				window.open(getUrl<?=$objectId;?>(2));;
			}
			toExcel<?=$objectId;?>=function(){
				window.open(getUrl<?=$objectId;?>(3));;
			}

			//initialize

			$("#filter_e1<?=$objectId;?>").attr({disabled:true});
			$("#filter_e2<?=$objectId;?>").attr({disabled:true});
			$("#unit<?=$objectId;?>").change(function(){
				var unit = $(this).val();
				$("#filter_e1<?=$objectId;?>").val('');
				$("#filter_e2<?=$objectId;?>").val('');
				switch(unit){
					case "KL":	
						$("#filter_e1<?=$objectId;?>").attr({disabled:true});
						$("#filter_e2<?=$objectId;?>").attr({disabled:true});
						break;
					case "E1":
						$("#filter_e1<?=$objectId;?>").attr({disabled:false});
						$("#filter_e2<?=$objectId;?>").attr({disabled:true});
						break;
					case "E2":
						$("#filter_e1<?=$objectId;?>").attr({disabled:false});
						$("#filter_e2<?=$objectId;?>").attr({disabled:false});
						break;
				}
			});
			
			$("#filter_e1<?=$objectId;?>").change(function(){
				var unit = $("#unit<?=$objectId;?>").val();
				if(unit=="E2"){
					$("#divUnitKerja<?=$objectId;?>").load(base_url+"rujukan/eselon2/loadFilterE2/"+$(this).val()+"/<?=$objectId;?>");
				}
			});
			
			setTimeout(function(){
				url = getUrl<?=$objectId;?>(1);
				
				
				$('#dg<?=$objectId;?>').datagrid({
					url:url
					
				});
			},0);
			
			// yanto
			$('#dg<?=$objectId;?>').datagrid({
				onClickCell: function(rowIndex, field, value){
					$('#dg<?=$objectId;?>').datagrid('selectRow', rowIndex);
					var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
					
					switch(field){
						case "kode_kl":
							showPopup('#popdesc<?=$objectId?>', row.nama_kl);
							break;
						case "kode_sasaran_kl":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_sasaran_kl);
							break;
						case "kode_iku_kl":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_iku_kl);
							break;
						case "kode_e1":
							showPopup('#popdesc<?=$objectId?>', row.nama_e1);
							break;
						case "kode_sasaran_e1":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_sasaran_e1);
							break;
						case "kode_iku_e1":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_iku_e1);
							break;
						case "kode_e2":
							showPopup('#popdesc<?=$objectId?>', row.nama_e2);
							break;
						case "kode_sasaran_e2":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_sasaran_e2);
							break;
						case "kode_ikk":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_ikk);
							break;
						default:
							closePopup('#popdesc<?=$objectId?>');
							break;
					}
				}
			});
			
			$("#popdesc<?=$objectId?>").click(function(){
				closePopup('#popdesc<?=$objectId?>');
			});
		 });
	</script>
	<style type="text/css">
		
		#fm<?=$objectId;?>{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			color:#666;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:80px;
		}
	  .fsearch{
		background:#fafafa;
		border-radius:5px;
		-moz-border-radius:0px;
		-webkit-border-radius: 5px;
		-moz-box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.2);
		-webkit-box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.2);
		filter: progid:DXImageTransform.Microsoft.Blur(pixelRadius=2,MakeShadow=false,ShadowOpacity=0.2);
		margin-bottom:10px;
		border: 1px solid #99BBE8;
	    color: #15428B;
	    font-size: 11px;
	    font-weight: bold;
	    position: relative;
	  }
	  .fsearch div{
		background:url('<?=base_url();?>public/css/themes/gray/images/panel_title.gif') repeat-x;
		height:200%;
		border-bottom: 1px solid #99BBE8;
		color:#15428B;
		font-size:10pt;
		text-transform:uppercase;
	    font-weight: bold;
	    padding: 5px;
	    position: relative;
	  }
	  .fsearch table{
	    padding: 15px;
	  }
	  .fsearch label{
		display:inline-block;
		width:60px;
	  }
		.fitemArea{
			margin-bottom:5px;
			text-align:left;
			/* border:1px solid blue; */
		}
		.fitemArea label{
			display:inline-block;
			width:84px;
			margin-bottom:5px;
		}
	</style>

	<div id="tb<?=$objectId;?>" style="height:auto">
		<table border="0" cellpadding="1" cellspacing="1" width="100%">
			<tr>
				<td>
				<div class="fsearch">
					<table border="0" cellpadding="1" cellspacing="1">
					<tr>
						<td width="60px">Tahun :</td>
						<td width="130px">
						</td>
						<td width="130px">Unit Kerja Eselon I :</td>
						<td>
							<?=$this->eselon1_model->getListFilterEselon1($objectId,$this->session->userdata('unit_kerja_e1'))?>				
						</td>
					</tr>
					<tr>
						<td width="60px">Unit :</td>
						<td width="130px">
							<select id="unit<?=$objectId?>" name="unit">
								<option value="KL">Kementerian</option>
								<option value="E1">Eselon 1</option>
								<option value="E2">Eselon 2</option>
							</select>
						</td>
						<td width="130px";>Unit Kerja Eselon II : </td>
						<td><span class="fitem" id="divUnitKerja<?=$objectId;?>">
							<?=$this->eselon2_model->getListFilterEselon2($objectId,$this->session->userdata('unit_kerja_e2'))?>
							</span>
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td align="right" colspan="4" valign="top">
							<a href="#" class="easyui-linkbutton" onclick="clearFilter<?=$objectId;?>();" iconCls="icon-reset">Reset</a>
							<a href="#" class="easyui-linkbutton" onclick="searchData<?=$objectId;?>();" iconCls="icon-search">Search</a>
						</td>
					</tr>
					</table>
				</div>
				</td>
			</tr>
		</table>
		<div style="margin-bottom:5px">  
			<!--<? if($this->sys_menu_model->cekAkses('PRINT;',556,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			
			<?}?>
			<? if($this->sys_menu_model->cekAkses('EXCEL;',556,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
			<?}?> -->
		</div>
	</div>
	
	<table id="dg<?=$objectId;?>" class="easyui-datagrid" style="height:auto;width:auto" title="Data Log Realisasi Kinerja" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="true" pagination="true">
	  <thead>
	  <tr>
		<th field="login_time" sortable="true" width="15">Login Time</th>
		<th field="ip" sortable="true" width="15">Ip Address</th>
		<th field="user_info" sortable="true" width="15" hidden="true">User Info</th>
		<th field="log_user_name" sortable="true" width="15">User Name</th>
		<th field="log_e1" sortable="true" width="15">Eselon I</th>
		<th field="log_e2" sortable="true" width="15">Eselon II</th>
	  </tr>
	  </thead>  
	</table>
	<div class="popdesc" id="popdesc<?=$objectId?>">indriyanto</div>