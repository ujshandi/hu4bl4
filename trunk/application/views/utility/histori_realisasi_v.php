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
					return "<?=base_url()?>utility/histori_realisasi/"+unit+"_grid/"+filtahun+"/"+file1+"/"+file2;
				}
				else if (tipe==2){
					return "<?=base_url()?>utility/histori_realisasi/"+unit+"_pdf/"+filtahun+"/"+file1+"/"+file2;
				}else if (tipe==3){
					return "<?=base_url()?>utility/histori_realisasi/"+unit+"_excel/"+filtahun+"/"+file1+"/"+file2;
				}
			}
			
			getColumn<?=$objectId;?> = function (){
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
				var unit = $("#unit<?=$objectId;?>").val();
				
				switch(unit){
					case "KL": return 	[[
											{field:'tahun',title:'Tahun',width:100},  
											{field:'triwulan',title:'Bulan',width:100},  
											{field:'kode_kl',title:'Kode Kementerian',width:100},
											{field:'nama_kl',title:'Nama Kementerian',width:100,hidden:true},
											{field:'kode_sasaran_kl',title:'Kode Sasaran Kementerian',width:100}, 
											{field:'deskripsi_sasaran_kl',title:'Deskripsi Sasaran Kementerian',width:100,hidden:true}, 
											{field:'kode_iku_kl',title:'Kode IKU Kementerian',width:100},
											{field:'deskripsi_iku_kl',title:'Deskripsi IKU Kementerian',width:100,hidden:true},
											{field:'realisasi',title:'Realisasi',width:100},
											{field:'log_status',title:'Status',width:100},
											{field:'log_user',title:'User',width:100},
											{field:'log_date',title:'Waktu',width:100}
										]]
						break; 
					case "E1": return 	[[
											{field:'tahun',title:'Tahun',width:100},  
											{field:'triwulan',title:'Bulan',width:100},  
											{field:'kode_e1',title:'Kode Eselon I',width:100},
											{field:'nama_e1',title:'Nama Eselon I',width:100,hidden:true},
											{field:'kode_sasaran_e1',title:'Kode Sasaran Eselon I',width:100},  
											{field:'deskripsi_sasaran_e1',title:'Deskripsi Sasaran Eselon I',width:100,hidden:true},  
											{field:'kode_iku_e1',title:'Kode IKU Eselon I',width:100},
											{field:'deskripsi_iku_e1',title:'Deskripsi IKU Eselon I',width:100,hidden:true},
											{field:'realisasi',title:'Realisasi',width:100},
											{field:'log_status',title:'Status',width:100},
											{field:'log_user',title:'User',width:100},
											{field:'log_date',title:'Waktu',width:100}
										]]
						break;
					case "E2": return 	[[
											{field:'tahun',title:'Tahun',width:100},  
											{field:'triwulan',title:'Bulan',width:100},  
											{field:'kode_e2',title:'Kode Eselon II',width:100},
											{field:'nama_e2',title:'Nama Eselon II',width:100,hidden:true},
											{field:'kode_sasaran_e2',title:'Kode Sasaran Eselon II',width:100},  
											{field:'deskripsi_sasaran_e2',title:'Deskripsi Sasaran Eselon II',width:100,hidden:true},  
											{field:'kode_ikk',title:'Kode IKK',width:100},
											{field:'deskripsi_ikk',title:'Deskripsi IKK',width:100,hidden:true},
											{field:'realisasi',title:'Realisasi',width:100},
											{field:'log_status',title:'Status',width:100},
											{field:'log_user',title:'User',width:100},
											{field:'log_date',title:'Waktu',width:100}
										]]
						break;
				}
				
			}
			
			searchData<?=$objectId;?> = function (){
				url = getUrl<?=$objectId;?>(1);
				coll = getColumn<?=$objectId;?>();
				
				$('#dg<?=$objectId;?>').datagrid({
					url:url,
					columns:coll
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
				coll = getColumn<?=$objectId;?>();
				
				$('#dg<?=$objectId;?>').datagrid({
					url:url,
					columns:coll
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
						<td width="130px"><?=$this->rskl_model->getListFilterTahun($objectId);?>
						&nbsp;&nbsp;
						&nbsp;&nbsp;
						<!--<select id="table<?=$objectId?>" name="table">
							<option value="sasaran">Sasaran</option>
							<option value="iku">IKU/IKK</option>
						</select>-->
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
			<? if($this->sys_menu_model->cekAkses('PRINT;',356,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<!--<a href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>-->
			<?}?>
			<? if($this->sys_menu_model->cekAkses('EXCEL;',356,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
			<?}?>
		</div>
	</div>
	
	<table id="dg<?=$objectId;?>" class="easyui-datagrid" style="height:auto;width:auto" title="Data Log Realisasi Kinerja" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="true" pagination="true">
	  <thead>
	  <tr>
		<th field="tahun" sortable="true" width="15">Tahun</th>
	  </tr>
	  </thead>  
	</table>
	<div class="popdesc" id="popdesc<?=$objectId?>">indriyanto</div>