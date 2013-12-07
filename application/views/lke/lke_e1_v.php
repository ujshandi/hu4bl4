<script  type="text/javascript" >
		var idLke_e1<?=$objectId;?>;
		var rowIndexDetail;

		$(function(){
			
			var url;
			newData<?=$objectId;?> = function (){  
				var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
				if (row){
					if (row.has_child) {
						alert("Pilih data subkomponen terlebih dahulu");
						return false;
					}
					$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','Add LKE Eselon I');  
					$('#fm<?=$objectId;?>').form('clear');  
					//alert(row.id);
					idLke_e1<?=$objectId;?> = row.id;
					url = base_url+'lke/lke_e1/save';  
					$("#tahun<?=$objectId?>").val($("#filter_tahun<?=$objectId?>").val());	
					$("#deskripsi_komponen<?=$objectId?>").load(base_url+'lke/lke_e1/loadtreeup/'+row.komponen_id);
					//$("#lke_e1_id<?=$objectId?>").val(row.lke_e1_id);
					$("#id_komponen<?=$objectId?>").val(row.komponen_id);
					$("#lke_e1_id<?=$objectId?>").val(row.lke_e1_id);
					$("#ref<?=$objectId?>").val(row.ref);
					$("#kode_e1<?=$objectId?>").val('<?=FILTER_E1?>');
					
					<? $i=0;
						foreach($listIndex->result() as $r){?>
						$('input:radio[name=index_mutu]:nth(<?=$i?>)').prop('checked',(row.index_mutu=='<?=$r->index_mutu?>'));
					<? $i++;
					 }?>
					
					
				}	
				else {
					alert("Pilih data subkomponen terlebih dahulu");
				}
				//addTab("Add PK Kementerian", "lke/lke_e1/add");
			}
			//end newData 
			
			clearFilter<?=$objectId;?> = function (){
				$("#filter_tahun<?=$objectId;?>").val('');
				searchData<?=$objectId;?>();
			}
			
			//tipe 1=grid, 2=pdf, 3=excel
			getUrl<?=$objectId;?> = function (tipe){
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
				var e1 = $("#kode_e1<?=$objectId;?>").val();
				if((filtahun==null)||(filtahun.length==0)) filtahun ="-1";
				if((e1==null)||(e1.length==0)) e1 ="-1";
				
				if (tipe==1){
					return "<?=base_url()?>lke/lke_e1/tree/"+filtahun+"/"+e1;
				}
				else if (tipe==2){
					return "<?=base_url()?>lke/lke_e1/pdf/"+filtahun+"/"+e1;
				}else if (tipe==3){
					return "<?=base_url()?>lke/lke_e1/excel/"+filtahun+"/"+e1;
				}
				
			}
			
			searchData<?=$objectId;?> = function (){
				//ambil nilai-nilai filter
				$('#dg<?=$objectId;?>').treegrid({
					url:getUrl<?=$objectId;?>(1),
				//	queryParams:{lastNo:'0'},	
				//	pageNumber : 1,
					onLoadSuccess:function(data){	
				//		$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						//prepareMerge<?=$objectId;?>(data);
				},onBeforeLoad: function(row,param){
                    if (!row) {    // load top level rows
                        param.id = 0;    // set id=0, indicate to load new page rows
                    }
                }});
			}
			//end searchData 		
		
			printData<?=$objectId;?>=function(){			
				//$.jqURL.loc(getUrl<?=$objectId;?>(2),{w:800,h:600,wintype:"_blank"});
			//window.open(getUrl<?=$objectId;?>(2));;
			alert("Sedang dalam pengerjaan");
		}
			toExcel<?=$objectId;?>=function(){
				alert("Sedang dalam pengerjaan");	
				//window.open(getUrl<?=$objectId;?>(3));;
			}
			
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
								title: 'Success',
								msg: result.msg
							}); */
							data = result.data;
							
							$('#dlg<?=$objectId;?>').dialog('close');		// close the dialog
							$('#dg<?=$objectId;?>').treegrid('refresh', idLke_e1<?=$objectId;?>);	// reload the user data
						//	alert(idLke_e1<?=$objectId;?>);
							//$('#ddv<?=$objectId;?>-'+rowIndexDetail).datagrid('reload');
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
			
			setTimeout(function(){
				searchData<?=$objectId;?>();		
			},0);
			
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
			<div class="fsearch" <?=($this->session->userdata('unit_kerja_e1')=='-1'?'':'')?>>
				<table border="0" cellpadding="1" cellspacing="1">
				<tr>
					<td>Tahun :</td>
					<td>
					<?=$this->lke_e1_model->getListTahun($objectId)?>
					</td>
				</tr>
				<tr>
					<td>Unit Kerja Eselon I :</td>
					<td>
					<?=$this->eselon1_model->getListFilterEselon1($objectId,FILTER_E1);?>
					</td>
				</tr>
				<tr style="height:10px">
					  <td style="">
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
	  
		<? if($this->sys_menu_model->cekAkses('ADD;',303,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-ok" plain="true">Set Nilai</a>  
		<?}?>
	
		<!------------Edit View
		<? if($this->sys_menu_model->cekAkses('EDIT;',302,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>(true);" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Edit</a>
		<?}?>
		<? if($this->sys_menu_model->cekAkses('VIEW;',302,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>(false);" class="easyui-linkbutton" iconCls="icon-view" plain="true">View</a>
		<?}?>-->
		
		<!--
		<a href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
		<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
		-->
	  </div>
	</div>
	<!-- class="easyui-datagrid" -->
	<table id="dg<?=$objectId;?>"  style="height:auto;width:auto" class="easyui-treegrid" nowrap="false"
	 title="Data LKE Pusat" idField="id" treeField="nama_komponen" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="true" pagination="false">
	  <thead>
	  <tr>
		<th field="has_child" hidden="true" sortable="true" width="50px">has_child</th> 
		<th field="komponen_id" hidden="true" sortable="true" width="50px">komponen_id</th> 
		<th field="lke_e1_id" hidden="true" sortable="true" width="50px">lke_e1_id</th> 
		<th field="nama_komponen" sortable="true" width="150px" rowspan="2">Komponen/Sub Komponen</th>		
		<th sortable="true" width="30px" colspan="2">Unit Kerja</th>		
		<th field="ref" sortable="false" width="30px" rowspan="2">REF</th>
	  </tr>
	  <tr>
		<th field="index_mutu" sortable="false" align="center" width="20px">Y/T.</th>
		<th field="nilai" sortable="false" align="center"  width="20px">Nilai</th>		
	  </tr>
	  </thead>  
	</table>
	
	<!-- Area untuk Form Add/Edit >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
	
	<div id="dlg<?=$objectId;?>" class="easyui-dialog" style="width:720px;height:400px;padding:10px 20px" closed="true"  buttons="#dlg-buttons">
		<!----------------Edit title-->
		
		<form id="fm<?=$objectId;?>" method="post" >			
			<div class="fitem">
				
					<div id="deskripsi_komponen<?=$objectId?>" cols="70" class="easyui-validatebox" ></div>
				<input type="hidden" id="lke_e1_id<?=$objectId?>" name="lke_e1_id"/>
				<input type="hidden" id="id_komponen<?=$objectId?>" name="id_komponen"/>				
				
			</div>
			
			<div class="fitem">
				
				<hr>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Tahun :</label>
				<input name="tahun" size="5" maxlength="4" id="tahun<?=$objectId?>" class="easyui-validatebox required">
			</div>
			<div class="fitem" >
				<label style="width:130px">Unit Kerja Eselon I :</label>
						<?php 
							$data['value'] = FILTER_E1;
							$this->eselon1_model->getListEselon1($objectId,$data);
						?>
			</div>	
			
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Index :</label>
				 <?=$indexmutu?>
			</div>
			
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Referensi :</label>
				<input name="ref" size="60" id="ref<?=$objectId?>" class="easyui-validatebox">
			</div>
			
			
		</form>
		<div id="dlg-buttons">
			<!----------------Edit title-->
			<a href="#" id="saveBtn<?=$objectId;?>" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData<?=$objectId;?>()">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg<?=$objectId;?>').dialog('close')">Cancel</a>
		</div>
	</div>
	
	<script type="text/javascript">
        $(function(){
			var parentId;
			// chan
			$('#dg<?=$objectId;?>').datagrid({
				url:getUrl<?=$objectId;?>(1),	
				//view: detailview,
				//idField:'id_komponen'
				queryParams:{rowIdx:'0'},	
                onExpandRow: function(index,row){
                }
			});
			
        });
    </script>
	<div class="popdesc" id="popdesc<?=$objectId?>">pops</div>
