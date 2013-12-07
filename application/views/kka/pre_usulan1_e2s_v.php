	<script  type="text/javascript" >
		$(function(){
			var url;
			newData<?=$objectId;?> = function (){  			
				addTab("Add Pra Monev Eselon II Pagu Usulan","kka/pre_usulan1_e2/add");
			}
			//end newData 
			
			editData<?=$objectId;?> = function (editmode){ 
				var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
				//alert(row.dokter_kode);
				if (row){
					if(editmode){
						if(row.status == '0'){
							addTab("Edit Pra Monev Eselon II Pagu Usulan", "kka/pre_usulan1_e2/edit/"+row.preusulan1_e2_id);
						}else{
							alert('Maaf data tidak bisa diedit, karena sudah ditetapkan di PK.');
						}
					}else{
						addTab("View Pra Monev Eselon II Pagu Usulan", "kka/pre_usulan1_e2/edit/"+row.preusulan1_e2_id+"/"+editmode);
					}
					
				}
			}
			
			deleteData<?=$objectId;?> = function (){
				<? if ($this->session->userdata('unit_kerja_e1')=='-1'){?>				
					var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
					if(row){
						if(confirm("Apakah yakin akan menghapus data '" + row.kode_ikk_e1 + "'?")){
							var response = '';
							$.ajax({ type: "GET",
									 url: base_url+'kka/pre_usulan1_e2/delete/' + row.preusulan1_e2_id,
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
				<?} else { ?>	
					alert("Silahkan Login sebagai Superadmin");
				<?} ?>
			}
			//end deleteData			
			
			clearFilter<?=$objectId;?> = function (){
				$("#filter_tahun<?=$objectId;?>").val('');
				$("#filter_e1<?=$objectId;?>").val('');
				searchData<?=$objectId;?>();
			}
			
			//tipe 1=grid, 2=pdf, 3=excel
			getUrl<?=$objectId;?> = function (tipe){
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
					<? if ($this->session->userdata('unit_kerja_e1')==-1){?>
					var file1 = $("#filter_e1<?=$objectId;?>").val();
				<?} else {?>
					var file1 = "<?=$this->session->userdata('unit_kerja_e1');?>";
				<?}?>
				if(filtahun==null) filtahun ="-1";
				if (file1 == null) file1 = "-1";
			
				if (tipe==1){
					return "<?=base_url()?>kka/pre_usulan1_e2/grid/"+filtahun+"/"+file1;
				}
				else if (tipe==2){
					return "<?=base_url()?>kka/pre_usulan1_e2/pdf/"+filtahun+"/"+file1;
				}else if (tipe==3){
					return "<?=base_url()?>kka/pre_usulan1_e2/excel/"+filtahun+"/"+file1;
				}
			}
			
			searchData<?=$objectId;?> = function (){
				//ambil nilai-nilai filter
				$('#dg<?=$objectId;?>').datagrid({
					url:getUrl<?=$objectId;?>(1),
					queryParams:{lastNo:'0'},	
					pageNumber : 1,
					onClickCell: function(rowIndex, field, value){
						$('#dg<?=$objectId;?>').datagrid('selectRow', rowIndex);
						var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
						
						switch(field){
							case "kode_sasaran_e2":
								showPopup('#popdesc<?=$objectId?>', row.deskripsi_sasaran_e1);
								break;
							case "kode_ikk":
								showPopup('#popdesc<?=$objectId?>', row.deskripsi);
								break;
							case "kode_e1":
								showPopup('#popdesc<?=$objectId?>', row.nama_e1);
								break;	
							case "kode_subkegiatan":
								showPopup('#popdesc<?=$objectId?>', row.nama_subkegiatan);
								break;
							default:
								closePopup('#popdesc<?=$objectId?>');
								break;
						}
					},
					onLoadSuccess:function(data){	
						$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						//prepareMerge<?=$objectId;?>(data);
				}});
			}
			//end searchData 
		
			printData<?=$objectId;?>=function(){			
				//$.jqURL.loc(getUrl<?=$objectId;?>(2),{w:800,h:600,wintype:"_blank"});
			window.open(getUrl<?=$objectId;?>(2));;
			//alert("Sedang dalam pengerjaan");
			}
			toExcel<?=$objectId;?>=function(){
				// alert("Sedang dalam pengerjaan");	
				window.open(getUrl<?=$objectId;?>(3));;
			}
			
			formatPrice=function (val,row){
				return val;//($.fn.autoNumeric.Format("txtAmount"+idx,total,{aSep:".",aDec:",",mDec:2}));
				/* if (val < 20){
					return '<span style="color:red;">('+val+')</span>';
				} else {
					return val;
				} */
			}

			setTimeout(function(){
				searchData<?=$objectId;?> ();
			},50);
			
		
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
			<div class="fsearch"?>
				<table border="0" cellpadding="1" cellspacing="1">
				<tr>
					<td>Tahun :</td>
					<td>
					<?=$this->sasaran_eselon2_model->getListFilterTahun($objectId)?>
					</td>
					<td width="10px"></td>
					<td>
						<a href="#" class="easyui-linkbutton" onclick="searchData<?=$objectId;?>();" iconCls="icon-search">Search</a>
					</td>
				</tr>
				</table>
			</div>
			</td>
		</tr>
		</table>
	  <div style="margin-bottom:5px"> 
		<? if($this->sys_menu_model->cekAkses('ADD;',68,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>  
		<?}?>
		<? if($this->sys_menu_model->cekAkses('EDIT;',68,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>(true);" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Edit</a>
		<?}?>
		<? if($this->sys_menu_model->cekAkses('VIEW;',68,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>(false);" class="easyui-linkbutton" iconCls="icon-view" plain="true">View</a>
		<?}?>
		<? if($this->sys_menu_model->cekAkses('DELETE;',68,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="deleteData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-remove" plain="true">Delete</a>
		<?}?>
		<!--
		<a href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
		<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
		-->
	  </div>
	</div>
	
	<table id="dg<?=$objectId;?>" style="height:auto;width:auto" title="Data Pra Monev Pagu Usulan  Eselon II" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="true" pagination="true" noWrap="false">
	  <thead>
	  <tr>
		<th field="preusulan1_e2_id" sortable="true" hidden="true" width="50px">preusulan1_e2_id</th>
		<th field="tahun" sortable="true" width="20px">Tahun</th>
		<th field="kode_e1" sortable="true" width="20px"<?=($this->session->userdata('unit_kerja_e1')=='-1'?'':'hidden="true"')?>>Kode Unit Kerja</th>
		<th field="nama_e1" hidden="true">nama e1</th>
		<th field="kode_sasaran_e2" sortable="true" width="40px">Kode Sasaran</th>
		<th field="deskripsi_sasaran_e2" hidden="true">deskripsi_sasaran_e1</th>
		<th field="kode_ikk" sortable="true" width="50px">Kode IKK</th>
		<th field="kode_subkegiatan" sortable="true" width="50px">Kode</th>
		<th field="deskripsi" hidden="true">deskripsi_ikk</th>
		<th field="nama_subkegiatan" sortable="true" width="250px">Kegiatan / Sub Kegiatan</th>
		<th field="jumlah" sortable="true" width="50px" align="right" formatter="formatPrice">Jumlah</th>		
	  </tr>
	  </thead>  
	</table>
	
	<div class="popdesc" id="popdesc<?=$objectId?>">indriyanto</div>