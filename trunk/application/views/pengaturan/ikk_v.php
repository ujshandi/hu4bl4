	<script  type="text/javascript" >
		$(function(){
			var url;
			loadTahun<?=$objectId;?> = function (){
				$('#divTahun<?=$objectId;?>').load(
					base_url+"pengaturan/ikk/getListTahun/"+"<?=$objectId;?>"
				);
			}
			
			loadTahun<?=$objectId;?>();
			
			setKodeOtomatis<?=$objectId?> = function(){
				<? if ($this->session->userdata('unit_kerja_e2')==-1){?>
					var file2 = $("#kode_e2<?=$objectId;?>").val();
				<?} else {?>
					var file2 = "<?=$this->session->userdata('unit_kerja_e2');?>";
				<?}?>
				var filtahun = $("#tahun<?=$objectId;?>").val();
				var kodesasaran = $("#kode_sasaran_e2ListSasaran<?=$objectId;?>").val();				
				if ((kodesasaran == null)||(kodesasaran == '')) kodesasaran = "-1";
				if (file2 == null) file2 = "-1";
				if ((filtahun == null)||(filtahun == '')) filtahun = "-1";
				$.ajax({url:base_url+"pengaturan/ikk/getNewCode/"+file2+"/"+filtahun+"/"+kodesasaran,
					success : function(data){
					$("#kode_ikk<?=$objectId?>").val(data);
					}					
					})
				
			}
			
			//chan=============================================
			 function setListE2<?=$objectId?>(){
				$("#divEselon2<?=$objectId?>").load(
					base_url+"rujukan/eselon2/loadE2/"+$("#kode_e1<?=$objectId?>").val()+"/<?=$objectId;?>",
					//on complete
					function (){
						//setSasaranE2<?=$objectId?>($("#kode_e2<?=$objectId?>").val());
						/* $("#kode_e2<?=$objectId?>").change(function(){
							setSasaranE2<?=$objectId?>($(this).val());
						});	
						setSasaranE2<?=$objectId?>($("#kode_e2<?=$objectId?>").val()); */
						
						 $("#kode_e2<?=$objectId?>").change(function(){
							setSasaranE2<?=$objectId;?>($("#tahun<?=$objectId?>").val(),$("#kode_e2<?=$objectId?>").val(),"");
							setKodeOtomatis<?=$objectId?>();
							
						 });
						 
						$('#kode_e2<?=$objectId;?>').val('<?=$this->session->userdata('unit_kerja_e2');?>');
						setSasaranE2<?=$objectId;?>($("#tahun<?=$objectId?>").val(),$("#kode_e2<?=$objectId?>").val(),"");
						 setKodeOtomatis<?=$objectId?>();
					}
				);
				
			//	setIKUE1<?=$objectId;?>($("#kode_e1<?=$objectId?>").val());
			 }
			 
			 $("#kode_e1<?=$objectId?>").change(function(){
				setListE2<?=$objectId?>();
				setIKUE1<?=$objectId;?>($("#tahun<?=$objectId?>").val(),$(this).val(),"","");
			 });
			 
			 $("#kode_e2<?=$objectId?>").change(function(){
				//setIKUE1<?=$objectId;?>($("#kode_e1<?=$objectId?>").val());
				alert("");
			 });
			 
			 $("#tahun<?=$objectId;?>").change(function(){
				 	setSasaranE2<?=$objectId;?>($(this).val(),$("#kode_e2<?=$objectId?>").val(),"");
				 setIKUE1<?=$objectId;?>($(this).val(),$("#kode_e1<?=$objectId?>").val(),"","");
				 setKodeOtomatis<?=$objectId?>();
			});
			  
			function setIKUE1<?=$objectId;?>(tahun,e1,key,val){
				if (tahun=="") tahun = "-1";
				$("#divIKUE1<?=$objectId?>").load(
					base_url+"pengaturan/ikk/getListIKU_E1/"+"<?=$objectId;?>"+"/"+e1+"/"+tahun,
					//on complete
					function(){
						$("textarea").autogrow();
						
						$("#txtkode_iku_e1<?=$objectId;?>").click(function(){
							$("#drop<?=$objectId;?>").slideDown("slow");
						});
						
						$("#drop<?=$objectId;?> li").click(function(e){
							var chose = $(this).text();
							$("#txtkode_iku_e1<?=$objectId;?>").val(chose);
							$("#drop<?=$objectId;?>").slideUp("slow");
						});
						
						if (key!=null)
							$('#kode_iku_e1<?=$objectId;?>').val(key);
						if (val!=null)
							$('#txtkode_iku_e1<?=$objectId;?>').val(val);
					}
				);
			}  
			
			
			  //inisialisasi
			 function initCombo<?=$objectId?>(){
				 setListE2<?=$objectId?>();
				 setSasaranE2<?=$objectId;?>($("#tahun<?=$objectId?>").val(),$("#kode_e2<?=$objectId?>").val(),"");
				 setIKUE1<?=$objectId;?>($("#tahun<?=$objectId?>").val(),$("#kode_e1<?=$objectId?>").val());
			 }
			 
			//end-------------------------------------
			newData<?=$objectId;?> = function (){  
				//----------------Edit title
				$('#ftitle<?=$objectId;?>').html("Add Data "+"<?=$title?>");
				$('#saveBtn<?=$objectId;?>').css("display","");
				$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','Add IKK Eselon II');
				$('#fm<?=$objectId;?>').form('clear');  
				$('#kode_e1<?=$objectId;?>').val('<?=$this->session->userdata('unit_kerja_e1');?>');
				initCombo<?=$objectId?>();
				url = base_url+'pengaturan/ikk/save/add';  
				
				$("#kode_ikk<?=$objectId?>").removeAttr('readonly');
			}
			//end newData 
			
			import<?=$objectId;?> = function (){  
				$('#dlgimport<?=$objectId;?>').dialog('open').dialog('setTitle','Import Indikator Kinerja Kegiatan');
				$('#fmimport<?=$objectId;?>').form('clear');  
				url = base_url+'pengaturan/ikk/import'; 
			}
			
			importData<?=$objectId;?>=function(){
				$('#fmimport<?=$objectId;?>').form('submit',{
					url: url,
					onSubmit: function(){
						//return $(this).form('validate');
					},
					success: function(result){
						//alert(result);
						var result = eval('('+result+')');
						if (result.success){
							 $.messager.show({
								title: 'Sukses',
								msg: result.msg
							});
							$('#dlgimport<?=$objectId;?>').dialog('close');		// close the dialog
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
			
			
			clearFilter<?=$objectId;?> = function (){
				$("#filter_e1<?=$objectId;?>").val('-1');
				<? if ($this->session->userdata('unit_kerja_e1')==-1) {?>
				$("#filter_e2<?=$objectId;?>").empty().append('<option value="-1">Semua</option>');		
				<?} else if (($this->session->userdata('unit_kerja_e1')!=null)&&($this->session->userdata('unit_kerja_e1')!=-1)) {?>
				$("#filter_e2<?=$objectId;?>").val('-1');
				<?}?>
				$("#filter_tahun<?=$objectId;?>").val('');	
				searchData<?=$objectId;?>();
			}
			
			getUrl<?=$objectId;?> = function (tipe){
				<? if ($this->session->userdata('unit_kerja_e1')==-1){?>
					var file1 = $("#filter_e1<?=$objectId;?>").val();
				<?} else {?>
					var file1 = "<?=$this->session->userdata('unit_kerja_e1');?>";
				<?}?>
				<? if ($this->session->userdata('unit_kerja_e2')==-1){?>
					var file2 = $("#filter_e2<?=$objectId;?>").val();
				<?} else {?>
					var file2 = "<?=$this->session->userdata('unit_kerja_e2');?>";
				<?}?>
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
				var filkey = $("#key<?=$objectId;?>").val();
				
				if (file1 == null) file1 = "-1";
				if (file2 == null) file2 = "-1";
				if (filtahun == null) filtahun = "-1";
				if (filkey == null) filkey = "-1";
				
				if (tipe==1){
					return "<?=base_url()?>pengaturan/ikk/grid/"+file1+"/"+file2+"/"+filtahun+"/"+filkey;
				}
				else if (tipe==2){
					return "<?=base_url()?>pengaturan/ikk/pdf/"+file1+"/"+file2+"/"+filtahun+"/"+filkey;
				}else if (tipe==3){
					return "<?=base_url()?>pengaturan/ikk/excel/"+file1+"/"+file2+"/"+filtahun+"/"+filkey;
				}
			}
			
			searchData<?=$objectId;?> = function (){
				//ambil nilai-nilai filter
				$('#dg<?=$objectId;?>').datagrid({
					url:getUrl<?=$objectId;?>(1),
					queryParams:{lastNo:'0'},	
					pageNumber : 1,
					onLoadSuccess:function(data){	
						$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						//prepareMerge<?=$objectId;?>(data);
				}});
			}
			//end searhData 
			
			printData<?=$objectId;?>=function(){
				window.open(getUrl<?=$objectId;?>(2));;
			}
			
			toExcel<?=$objectId;?>=function(){
				window.open(getUrl<?=$objectId;?>(3));;
			}
			
			editData<?=$objectId;?> = function (editmode){
				//----------------Edit title
				$('#ftitle<?=$objectId;?>').html((editmode?"Edit Data ":"View Data ")+"<?=$title?>");
				$('#saveBtn<?=$objectId;?>').css("display",(editmode)?"":"none");
				var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
				$('#fm<?=$objectId;?>').form('clear');  
			//
				//alert(row.dokter_kode);
				if (row){
					$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','Edit IKK Eselon II');
					$('#fm<?=$objectId;?>').form('load',row);
					//	initCombo();
					setListE2<?=$objectId?>();
					setIKUE1<?=$objectId;?>($("#tahun<?=$objectId?>").val(),$("#kode_e1<?=$objectId?>").val(),row.kode_iku_e1,row.deskripsi_e1);
					url = base_url+'pengaturan/ikk/save/edit/'+row.kode_ikk+"/"+row.tahun;//+row.id;//'update_user.php?id='+row.id;
					
					$("#kode_ikk<?=$objectId?>").attr("readonly","readonly");
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
							/*  $.messager.show({
								title: 'Sucsees',
								msg: result.msg
							});  */
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
					if(confirm("Apakah yakin akan menghapus data '" + row.kode_ikk + "'?")){
						var response = '';
						$.ajax({ type: "GET",
								 url: base_url+'pengaturan/ikk/delete/' + row.tahun + '/' + row.kode_ikk,
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
			
			$("#filter_e1<?=$objectId;?>").change(function(){
				$("#divUnitKerja<?=$objectId;?>").load(base_url+"rujukan/eselon2/loadFilterE2/"+$(this).val()+"/<?=$objectId;?>");
			
			});
			setTimeout(function(){
				searchData<?=$objectId;?> ();
				//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>pengaturan/ikk/grid"});
			},50);
			
			// yanto
			$('#dg<?=$objectId;?>').datagrid({
				onClickCell: function(rowIndex, field, value){
					$('#dg<?=$objectId;?>').datagrid('selectRow', rowIndex);
					var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
					
					switch(field){
						case "kode_e2":
							showPopup('#popdesc<?=$objectId?>', row.nama_e2);
							break;
						case "kode_iku_e1":
							showPopup('#popdesc<?=$objectId?>', row.e1_deskripsi);
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
			
			//chan
			function setSasaranE2<?=$objectId;?>(tahun,e2,key,val){
				<? if ($this->session->userdata('unit_kerja_e2')!='-1') {?>
				 e2 = '<?=$this->session->userdata('unit_kerja_e2');?>';
				 $("#kode_e2<?=$objectId;?>").val(e2);
				<?}?>
				if (tahun=="") tahun = "-1";
				 $("#divSasaranE2<?=$objectId?>").load(
					base_url+"pengaturan/sasaran_eselon2/getListSasaranE2/ListSasaran"+"<?=$objectId;?>"+"/"+e2+"/"+tahun,
					function(){
						$("textarea").autogrow();
						
						$("#txtkode_sasaran_e2ListSasaran<?=$objectId;?>").click(function(){
							$("#dropListSasaran<?=$objectId;?>").slideDown("slow");
						});
						
						$("#dropListSasaran<?=$objectId;?> li").click(function(e){
							var chose = $(this).text();
							$("#txtkode_sasaran_e2ListSasaran<?=$objectId;?>").val(chose);
							$("#dropListSasaran<?=$objectId;?>").slideUp("slow");
						});
						
						if (key!=null)
							$('#kode_sasaran_e2ListSasaran<?=$objectId;?>').val(key);
						if (val!=null)
							$('#txtkode_sasaran_e2ListSasaran<?=$objectId;?>').val(val);
					}
				); 
				//alert("here");
				
			}
		 });
	</script>
	
	<script>
		<!--Enter-->
		function submitEnter<?=$objectId;?>(e) {
			if (e.keyCode == 13) {
				searchData<?=$objectId;?>();
			}
		}
	</script>
	
	<!-- Dari Stef -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*initCombo = function(){
				if($("#drop<?=$objectId;?>").is(":visible")){
					$("#drop<?=$objectId;?>").slideToggle("slow");
				}
				
				$("#txtkode_iku_e1<?=$objectId;?>").click(function(){
					$("#drop<?=$objectId;?>").slideToggle("slow");
				});
				
				$("#drop<?=$objectId;?> li").click(function(e){
					var chose = $(this).text();
					$("#txtkode_iku_e1<?=$objectId;?>").val(chose);
					$("#drop<?=$objectId;?>").slideToggle("slow");
				});
			}*/

		});
		
		function setIku<?=$objectId;?>(valu){
			document.getElementById('kode_iku_e1<?=$objectId;?>').value = valu;
		}
		
		 function setSasaranListSasaran<?=$objectId;?>(valu){
			//alert("here");
				document.getElementById('kode_sasaran_e2ListSasaran<?=$objectId;?>').value = valu;
				 setKodeOtomatis<?=$objectId?>();
			}
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
			float: left;
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
				<div class="fsearch" <?=""//($this->session->userdata('unit_kerja_e2')=='-1'?'':'style="display:none"')?>>
					<table border="0" cellpadding="1" cellspacing="1">
					<tr>
						<td>Tahun :</td>
						<td><span id="divTahun<?=$objectId?>"></span></td>
					</tr>
					<? //if ($this->session->userdata('unit_kerja_e1')==-1){?>
					<tr>
						<td>Unit Kerja Eselon I &nbsp</td>
						<td>
							<?=$this->eselon1_model->getListFilterEselon1($objectId,$this->session->userdata('unit_kerja_e1'))?>				
						</td>
					</tr>
					<?//}?>
					<tr>
						<td>Unit Kerja Eselon II &nbsp</td>
						<td><span class="fitem" id="divUnitKerja<?=$objectId;?>">
							<?=$this->eselon2_model->getListFilterEselon2($objectId,$this->session->userdata('unit_kerja_e1'),$this->session->userdata('unit_kerja_e2'))?>
						</span>
						</td>
					</tr>
					<tr>
						<td>Kata Kunci :</td>
						<td><input id="key<?=$objectId;?>" name="key<?=$objectId;?>" type="text" onkeypress="submitEnter<?=$objectId;?>(event)"/></td>
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
			<? if($this->sys_menu_model->cekAkses('ADD;',36,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>  
			<?}?>
			<!----------------Edit title-->
			<? if($this->sys_menu_model->cekAkses('EDIT;',36,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a 	href="#" onclick="editData<?=$objectId;?>(true);" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Edit</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('VIEW;',36,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="editData<?=$objectId;?>(false);" class="easyui-linkbutton" iconCls="icon-view" plain="true">View</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('DELETE;',36,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="deleteData<?=$objectId;?>(false);" class="easyui-linkbutton" iconCls="icon-remove" plain="true">Delete</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('PRINT;',36,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('EXCEL;',36,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('IMPORT;',36,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="import<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-import" plain="true">Import</a>
			<?}?>
		</div>
	</div>
	
	<table id="dg<?=$objectId;?>" class="easyui-datagrid" style="height:auto;width:auto" title="Data Indikator Kinerja Kegiatan (IKK) Eselon II" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="true" pagination="true"  nowrap="false">
	<thead>
		<tr>
			<th field="tahun" sortable="true" width="15px">Tahun</th>
			<th field="kode_e2" sortable="true" width="25"<?=($this->session->userdata('unit_kerja_e2')=='-1'?'':'hidden="true"')?>>Kode Eselon II</th>
			<th field="nama_e2" hidden="true">Nama</th>
			<th field="kode_e1" sortable="true" width="35" hidden="true">Kode E1</th>
			<th field="kode_ikk" sortable="true" width="35">Kode IKK</th>
			<th field="deskripsi" sortable="true" width="125">Deskripsi</th>
			<th field="satuan" sortable="true" width="20">Satuan</th>
			<th field="kode_iku_e1" sortable="true" width="30">Kode IKU Eselon I</th>
			<th field="e1_deskripsi" hidden="true">desk</th>
		</tr>
	</thead>  
	</table>

	<!-- AREA untuk Form Add/EDIT >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
	
	<div id="dlg<?=$objectId;?>" class="easyui-dialog" style="width:700px;height:400px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
		<!----------------Edit title-->
		<div id="ftitle<?=$objectId?>" class="ftitle">Add/Edit/View Data Indikator Kerja Kegiatan</div>
		<form id="fm<?=$objectId;?>" method="post">
			<div class="fitem">
				<label style="width:120px">Tahun :</label>
				<input name="tahun" id="tahun<?=$objectId;?>" class="easyui-validatebox" required="true" size="5" >
			</div>	
			<!-- chan : Jika login superadmin maka tampilkan combo E1 utk nge filter list E2 -->
			<? //if ($this->session->userdata('unit_kerja_e1')=='-1'){?>
			<div class="fitem">							
				<label style="width:120px">Unit Kerja Eselon I :</label>
				<? //if ($this->session->userdata('unit_kerja_e1')=='-1'){
					$this->eselon1_model->getListEselon1($objectId);
				//} else { 
					//echo $this->eselon1_model->getNamaE1($this->session->userdata('unit_kerja_e1'));
				//} ?>
			</div>					
			<?//}?>
			<div class="fitem">							
				<label style="width:120px">Unit Kerja Eselon II :</label>
				<span id="divEselon2<?=$objectId?>">
				<?
				/* CHAN 
				if ($this->session->userdata('unit_kerja_e2')=='-1'){
					$this->eselon2_model->getListEselon2($objectId);
				} else { 
					echo $this->eselon2_model->getNamaE2($this->session->userdata('unit_kerja_e2'));
				} */?>
				</span>
			</div>
			<div class="fitem">
				<label style="width:120px">Sasaran Eselon 2:</label>					
					<span id="divSasaranE2<?=$objectId?>">
				</span>
			</div>
			<div class="fitem">
				<label style="width:120px;vertical-align:top">Kode IKK :</label>
				<input name="kode_ikk" class="easyui-validatebox" size="30" required="true" readonly="readonly" id="kode_ikk<?=$objectId;?>" >
			</div>
			<div class="fitem" >
				<label style="width:120px">IKU Eselon I :</label>
				<span id="divIKUE1<?=$objectId?>">
				<?//$this->iku_e1_model->getListIKU_E1($objectId)?>
				</span>
			</div>
			<div class="fitem">
				<label style="width:120px;vertical-align:top">Deskripsi IKK :</label>
				<textarea name="deskripsi" cols="70" class="easyui-validatebox" ></textarea>
			</div>
			<div class="fitem">
				<label style="width:120px;vertical-align:top">Satuan :</label>
				<input name="satuan" class="easyui-validatebox" size="60" required="true">
			</div>
		</form>
		<div id="dlg-buttons">
			<!----------------Edit title-->
			<a href="#" id="saveBtn<?=$objectId;?>" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData<?=$objectId;?>()">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg<?=$objectId;?>').dialog('close')">Cancel</a>
		</div>
	</div>

	
	
	<!-- FORM IMPORT -->
	<div id="dlgimport<?=$objectId;?>" class="easyui-dialog" style="width:500px;height:200px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Import Data IKK dari Excel</div>
		<?php 
			$attributes = array('id' => 'fmimport'.$objectId);
			echo form_open_multipart('', $attributes);
		?>	
			<div class="fitem">
				<label style="width:60px;vertical-align:top">File :</label>
				<input type="file" name="datafile"/>
			</div>
		</form>
    	<div id="dlg-buttons">
			<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="importData<?=$objectId;?>()">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgimport<?=$objectId;?>').dialog('close')">Cancel</a>
    	</div>
	</div>

	<div class="popdesc" id="popdesc<?=$objectId?>">indriyanto</div>
