	<script  type="text/javascript" >
		$(function(){
			var url;
			newData<?=$objectId;?> = function (){  
				//$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','New kegiatankl');  
				//$('#fm<?=$objectId;?>').form('clear');  
				//url = base_url+'penetapan/kegiatankl/save';  
				
				addTab("Add Sub Kegiatan", "rujukan/subkegiatankl/add");
			}
			//end newData 
			
			
			clearFilter<?=$objectId;?> = function (){
				$("#filter_e1<?=$objectId;?>").val('-1');
				<? if ($this->session->userdata('unit_kerja_e1')==-1) {?>
				$("#filter_e2<?=$objectId;?>").empty().append('<option value="-1">Semua</option>');		
				<?} else if (($this->session->userdata('unit_kerja_e1')!=null)&&($this->session->userdata('unit_kerja_e1')!=-1)) {?>
				$("#filter_e2<?=$objectId;?>").val('-1');
				<?}?>
			}
			
			//tipe 1=grid, 2=pdf, 3=excel
			getUrl<?=$objectId;?> = function (tipe){
			<? if (($this->session->userdata('unit_kerja_e1')!=null)&&($this->session->userdata('unit_kerja_e1')!=-1)) {?>	
				var file1 = '<?=$this->session->userdata('unit_kerja_e1')?>'
			<?} else {?>	
				var file1 = $("#filter_e1<?=$objectId;?>").val();
			<? }?>	
				var file2 = $("#filter_e2<?=$objectId;?>").val();
			
			var tahun = $("#filter_tahun<?=$objectId;?>").val();
			if (file1 == null) file1 = "-1";
			if (file2 == null) file2 = "-1";
			if (tahun == null) tahun = "-1";
		
			if (tipe==1){
				return "<?=base_url()?>rujukan/subkegiatankl/grid/"+file1+"/"+file2+"/"+tahun;
			}
			else if (tipe==2){
				return "<?=base_url()?>rujukan/subkegiatankl/pdf/"+file1+"/"+file2;
			}else if (tipe==3){
				return "<?=base_url()?>rujukan/subkegiatankl/excel/"+file1+"/"+file2;
			}
		}
			
			searchData<?=$objectId;?> = function (){
				$('#dg<?=$objectId;?>').datagrid({
					url:getUrl<?=$objectId;?>(1),
					queryParams:{lastNo:'0'},	
					pageNumber : 1,
					onLoadSuccess:function(data){	
						$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
					}});
			}
			//end searhData 
			
			printData<?=$objectId;?>=function(){
				window.open(getUrl<?=$objectId;?>(2));;
			}
			
			toExcel<?=$objectId;?>=function(){
				window.open(getUrl<?=$objectId;?>(3));;
			}
			
			editData<?=$objectId;?> = function (){
			var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
			if (row){
				addTab("Edit Sub Kegiatan", "rujukan/subkegiatankl/edit/"+row.id_subkegiatan_kl);
			}
		}
		//end editData
		
			
			saveData<?=$objectId;?>=function(){
				$('#fm<?=$objectId;?>').form('submit',{
					url: url,
					onSubmit: function(){
						return $(this).form('validate');
					},
					success: function(result){
						//alert(result);
						var result = eval('('+result+')');
						if (result.success){
							/* $.messager.show({
								title: 'Sucsees',
								msg: result.msg
							}); */
							$('#dlg<?=$objectId;?>').dialog('close');		// close the dialog
							$('#dg<?=$objectId;?>').datagrid('reload');	// reload the user data
						} else {
							$.messager.show({
								title: 'Error',
								msg: result.msg
							});
						}
					}
				});
			}
			//end saveData
			
			deleteData<?=$objectId;?> = function (){
				
					var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
					if(row){
						if(confirm("Apakah yakin akan menghapus data '" + row.nama_subkegiatan + "'?")){
							var response = '';
							$.ajax({ type: "GET",
									 url: base_url+'rujukan/subkegiatankl/delete/' + row.id_subkegiatan_kl,
									 async: false,
									 success : function(response)
									 {
										var response = eval('('+response+')');
										if (response.success){
											$.messager.show({
												title: 'Success',
												msg: 'Data Berhasil Dihapus'
											});
											
											// reload and close tab
											$('#dg<?=$objectId;?>').datagrid('reload');
										} else {
											$.messager.show({
												title: 'Error',
												msg: response.msg
											});
										}
									 }
							});
						}
					}
				
			}
			//end deleteData	
			
			formatPrice=function (val,row){
				return val;//($.fn.autoNumeric.Format("txtAmount"+idx,total,{aSep:".",aDec:",",mDec:2}));
				/* if (val < 20){
					return '<span style="color:red;">('+val+')</span>';
				} else {
					return val;
				} */
			}

			$("#filter_e1<?=$objectId;?>").change(function(){
				$("#divUnitKerja<?=$objectId;?>").load(base_url+"rujukan/subkegiatan/loadFilterSubKegiatan/"+$(this).val()+"/<?=$objectId;?>");
			
			});
			
			setTimeout(function(){
				searchData<?=$objectId;?>();
			},0);
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
		  <div class="fsearch" <?//=(($this->session->userdata('unit_kerja_e2')=='-1')||($this->session->userdata('unit_kerja_e2')=='')?'':'style="display:none"')?>>
			
			<table border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td>Tahun&nbsp;</td>
				<td>
					<?=$this->subkegiatankl_model->getListTahun($objectId)?>				
				</td>
			</tr>
			<tr>
				<td>Unit Kerja Eselon I&nbsp;</td>
				<td>
					<?=$this->eselon1_model->getListFilterEselon1($objectId,$this->session->userdata('unit_kerja_e1'))?>				
				</td>
			</tr>
			
			<tr>
				<td>Unit Kerja Eselon II&nbsp</td>
				<td><span class="fitem" id="divUnitKerja<?=$objectId;?>">
					<?=$this->eselon2_model->getListFilterEselon2($objectId,$this->session->userdata('unit_kerja_e1'),$this->session->userdata('unit_kerja_e2'))?>
					</span>
				</td>
			</tr>
			<tr>
			  
			  <td align="right" colspan="2" valign="top">
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
		<? if($this->sys_menu_model->cekAkses('ADD;',8,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>  
		<?}?>
		<? if($this->sys_menu_model->cekAkses('EDIT;',8,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Edit</a>
		<?}?>
		<? if($this->sys_menu_model->cekAkses('DELETE;',8,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="deleteData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-remove" plain="true">Delete</a>
		<?}?>
		<? if($this->sys_menu_model->cekAkses('PRINT;',8,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
		<?}?>
		<? if($this->sys_menu_model->cekAkses('EXCEL;',8,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
		<?}?>
		<!--
		<a href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
		-->
	  </div>
	</div>
	
	<table id="dg<?=$objectId;?>" style="height:auto;width:auto" title="Sub Kegiatan Kementerian" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="true" pagination="true">
	  <thead>
	  <tr>
		<th field="id_subkegiatan_kl" hidden="true" sortable="true" width="15px">No</th>
		<th field="tahun" sortable="true" width="10px">Tahun</th>
		<th field="kode_satker" sortable="true" hidden="true" width="15px">Kode Satker</th>
		<th field="kode_kegiatan" sortable="true" width="20px">Kode Kegiatan</th>
		<th field="kode_subkegiatan" sortable="true" width="30px">Kode Sub Kegiatan</th>
		<th field="nama_subkegiatan" sortable="true" width="75px">Nama Sub Kegiatan</th>
		<th field="lokasi"  hidden="true" sortable="true" width="25px">Lokasi</th>
		<th field="volume"  hidden="true" sortable="true" width="15px">Volume</th>
		<th field="satuan" hidden="true"  sortable="true" width="15px">Satuan</th>
		<th field="total" sortable="true" width="20px" align="right" formatter="formatPrice">Total</th>		
	  </tr>
	  </thead>  
	</table>
