	<script  type="text/javascript" >
		$(function(){
			var url;
			
			clearFilter<?=$objectId;?> = function (){
				//ambil nilai-nilai filter
				$("#filter_tahun<?=$objectId;?>").val(''); 			
				$("#filter_e1<?=$objectId;?>").val('');			
				$("#filter_sasaran<?=$objectId;?>").val('');			
				$("#filter_iku<?=$objectId;?>").val('');			
				//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>lke/kke2b/grid/"+filtahun+"/"+filnama+"/"+filalamat});
					//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>lke/kke2b/grid/"+filtahun+"/"+filnama+"/"+filalamat});
			}
			
				//tipe 1=grid, 2=pdf, 3=excel
			getUrl<?=$objectId;?> = function (tipe){
				//jika tipe pdf&excel kirim jg paging datanya agar sesuai dengan grid				
				var paging="";
				if ((tipe==2)||(tipe==3)){
					var page =  $('#dg<?=$objectId;?>').datagrid('options').pageNumber;
					var rows = $('#dg<?=$objectId;?>').datagrid('options').pageSize;
				//	alert(page);
					if (rows==null) rows = "-1";
					if (page==null) page = "-1";
					paging = "/"+page+"/"+rows;						
				}
			
					//ambil nilai-nilai filter
				//alert($("#filter_tahun<?=$objectId;?>").val());
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
				<? if ($this->session->userdata('unit_kerja_e1')==-1){?>
					var file1 = $("#filter_e1<?=$objectId;?>").val();
				<?} else {?>
					var file1 = "<?=$this->session->userdata('unit_kerja_e1');?>";
				<?}?>
				
				 if(filtahun==null) filtahun ="-1";
				 if((file1==null)||(file1.length==0)) file1 ="-1";
				var filsasaran = "-1";
				var filiku = "-1";
				
				if (tipe==1){
					return "<?=base_url()?>lke/kke2b/grid/"+filtahun+"/"+file1;
				}
				else if (tipe==2){
					return "<?=base_url()?>lke/kke2b/pdf/"+filtahun+"/"+file1+"/"+filsasaran+"/"+filiku+paging;
				}else if (tipe==3){
					return "<?=base_url()?>lke/kke2b/excel/"+filtahun+"/"+file1+"/"+filsasaran+"/"+filiku+paging;
				}
				
			}
			
			var url;
			newData<?=$objectId;?> = function (){  
				/* var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
				if (row){
					if (row.has_child) {
						alert("Pilih data subkomponen terlebih dahulu");
						return false;
					} */
					
					var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
					if (row){
						$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','Add KKE2B-Sasaran');  
						$('#fm<?=$objectId;?>').form('clear');  						
						//initCombo<?=$objectId?>();
						url = base_url+'lke/kke2b/save';  
						$("#kke2b_e1_id<?=$objectId?>").val(row.kke2b_e1_id);
						$("#tahun<?=$objectId?>").val(row.tahun);
						$("#kode_e1<?=$objectId?>").val('<?=FILTER_E1?>');
						$("#spanTahun<?=$objectId?>").text(row.tahun);
						$("#kode_sasaran_e1<?=$objectId?>").val(row.kode_sasaran_e1);
						$("#spanSasaran<?=$objectId?>").text(row.sasaran_strategis);						
						
						<? $i=0;
						foreach($listIndex_renstra_a->result() as $r){?>
							$('input:radio[name=renstra_a]:nth(<?=$i?>)').prop('checked',(row.renstra_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_rkt_a->result() as $r){?>
							$('input:radio[name=rkt_a]:nth(<?=$i?>)').prop('checked',(row.rkt_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_pk_a->result() as $r){?>
							$('input:radio[name=pk_a]:nth(<?=$i?>)').prop('checked',(row.pk_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_renstra_b->result() as $r){?>
							$('input:radio[name=renstra_b]:nth(<?=$i?>)').prop('checked',(row.renstra_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_rkt_b->result() as $r){?>
							$('input:radio[name=rkt_b]:nth(<?=$i?>)').prop('checked',(row.rkt_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_pk_b->result() as $r){?>
							$('input:radio[name=pk_b]:nth(<?=$i?>)').prop('checked',(row.pk_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						/* $('input:radio[name=renstra_a]:nth(0)').prop('checked',(row.renstra_a=='Y'));
						$('input:radio[name=renstra_a]:nth(1)').prop('checked',(row.renstra_a=='T'));
						$('input:radio[name=rkt_a]:nth(0)').prop('checked',(row.rkt_a=='Y'));
						$('input:radio[name=rkt_a]:nth(1)').prop('checked',(row.rkt_a=='T'));						
						$('input:radio[name=pk_a]:nth(0)').prop('checked',(row.pk_a=='Y'));
						$('input:radio[name=pk_a]:nth(1)').prop('checked',(row.pk_a=='T'));
						
						$('input:radio[name=renstra_b]:nth(0)').prop('checked',(row.renstra_b=='Y'));
						$('input:radio[name=renstra_b]:nth(1)').prop('checked',(row.renstra_b=='T'));
						$('input:radio[name=rkt_b]:nth(0)').prop('checked',(row.rkt_b=='Y'));
						$('input:radio[name=rkt_b]:nth(1)').prop('checked',(row.rkt_b=='T'));						
						$('input:radio[name=pk_b]:nth(0)').prop('checked',(row.pk_b=='Y'));
						$('input:radio[name=pk_b]:nth(1)').prop('checked',(row.pk_b=='T')); */
					}	
					else {
						alert('Data sasaran belum dipilih!');
					}
					
				/* }	
				else {
					alert("Pilih data subkomponen terlebih dahulu");
				} */
				//addTab("Add PK Kementerian", "lke/kke2b/add");
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
			
			
			searchData<?=$objectId;?> = function (){
				$('#dg<?=$objectId;?>').datagrid({
					url:getUrl<?=$objectId;?>(1),
					pageNumber : 1,
					onLoadSuccess:function(data){
						//var  rows = $('#dg<?=$objectId;?>').datagrid('getRows');
					//	alert(rows.length);
						$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						prepareMerge<?=$objectId;?>(data);
					},					
					queryParams:{lastNo:'0'}
				}); 
			}
			//end searhData 
			
			printData<?=$objectId;?>=function(){			
				//$.jqURL.loc(getUrl<?=$objectId;?>(2),{w:800,h:600,wintype:"_blank"});
				//window.open(getUrl<?=$objectId;?>(2));;
				alert("Fasilitas Pdf belum tersedia");
			}
			toExcel<?=$objectId;?>=function(){
				alert("Fasilitas Excel belum tersedia");
				//window.open(getUrl<?=$objectId;?>(3));;
			}
			
			prepareMerge<?=$objectId;?> = function(data){
				var  rows = data.rows;//$('#dg<?=$objectId;?>').datagrid('getRows');
				var merges = new Array();
				var sasaran = "";
				var idx=0;
				var rowSpan = 0;
				//alert(rows.length);
				for (var i=0;i<rows.length;i++){
					
					if (sasaran!=rows[i].sasaran_strategis){
						sasaran =rows[i].sasaran_strategis;
					//	alert(sasaran);
						if (i>0){
					//	alert("kadieu og gening");
							merges[idx] = new Array();
							merges[idx][0] =i-rowSpan-1;//index
							merges[idx][1] =rowSpan+1;//rowspan
							idx++;
							rowSpan =0;
						}
						else {
							//rowSpan++;
						}
						//alert(sasaran);
					}
					else{
						if (i==rows.length-1){
							//alert("kadieu tes");
							merges[idx] = new Array();
							merges[idx][0] =i-rowSpan-1;//index
							merges[idx][1] =rowSpan+2;//rowspan
							idx++;
							rowSpan =0;
						}	  
						rowSpan++;
					}
					/*  if (i==rows.length-1){
						//alert("kadieu tes");
						merges[idx] = new Array();
						merges[idx][0] =idx;//index
						merges[idx][1] =rowSpan;//rowspan
						idx++;
						rowSpan =0;
					}	  */
					
				}
				
				
				
				//alert(merges.length);
				for(var i=0; i<merges.length; i++){
				//alert(merges[i][1]);
						$('#dg<?=$objectId;?>').datagrid('mergeCells',{
							index:merges[i][0],
							field:'sasaran_strategis',
							rowspan:merges[i][1]
						});
						 $('#dg<?=$objectId;?>').datagrid('mergeCells',{
							index:merges[i][0],
							field:'no',
							rowspan:merges[i][1]
						}); 
				}
				
				
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
				/* $('#dg<?=$objectId;?>').datagrid({
				url:"<?=base_url()?>lke/kke2b/grid",
				queryParams:{lastNo:'0'},		
					onLoadSuccess:function(data){
						$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						prepareMerge<?=$objectId;?>(data);
					}}); */
					searchData<?=$objectId?>();
			},50);
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
		  <div class="fsearch" >			
			<table border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td>Tahun :</td>
				<td>
				<?=$this->sasaran_eselon1_model->getListFilterTahun($objectId,false)?>
				</td>
				<td width="10px">&nbsp;</td>
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
	  <? if($this->sys_menu_model->cekAkses('ADD;',307,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-ok" plain="true">Set Kinerja</a>  
		<?}?>
	
		
		
			<? if($this->sys_menu_model->cekAkses('PRINT;',307,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a 	href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('EXCEL;',307,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
			<?}?>
	  </div>
	</div>
	
	<table id="dg<?=$objectId;?>" style="height:auto;width:auto" title="Laporan kke2b Sasaran" toolbar="#tb<?=$objectId;?>" fitColumns="false" singleSelect="true" rownumbers="false" pagination="true"  nowrap="false" showFooter="true">
	  <thead>
	  <tr>
		
		<th field="no" rowspan="4" sortable="false"  halign="center" align="center"  width="25px">No.</th>
		<th field="kke2b_e1_id" rowspan="4" sortable="false" hidden="true" width="25px">kke2b_e1_id</th>
		<th field="tahun" rowspan="4" sortable="false" hidden="true" width="25px">tahun</th>
		<th field="kode_sasaran_e1" rowspan="4" sortable="false" hidden="true" width="25px">kode_sasaran_e1</th>
		<th field="sasaran_strategis"  rowspan="4"   halign="center" align="left" sortable="false" width="450px">Sasaran Strategis</th>		
		<th colspan="12" sortable="false" align="center"  halign="center" align="center" width="680px" >Orientasi Hasil</th>
		
	  </tr>
	  <tr>				
		<th sortable="false"  halign="center" align="center" colspan="4" width="220px">Renstra IP</th>
		<th sortable="false"  halign="center" align="center" colspan="4" width="220px">RKT IP</th>
		<th sortable="false"  halign="center" align="center" colspan="4" width="220px">PK IP</th>		
	  </tr>
	  <tr>				
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		
	  </tr>
	  <tr>		
		
		<th field="renstra_a" sortable="false" halign="center" align="center" width="50px">Index</th>		
		<th field="renstra_a_nilai" sortable="false" halign="center" align="center"  width="60px">Nilai</th>
		<th field="renstra_b" sortable="false" halign="center" align="center" width="50px">Index</th>		
		<th field="renstra_b_nilai" sortable="false" halign="center" align="center"  width="60px">Nilai</th>
		<th field="rkt_a" sortable="false" halign="center" align="center" width="50px">Index</th>		
		<th field="rkt_a_nilai" sortable="false" halign="center" align="center"  width="60px">Nilai</th>	
		<th field="rkt_b" sortable="false" halign="center" align="center" width="50px">Index</th>		
		<th field="rkt_b_nilai" sortable="false" halign="center" align="center"  width="60px">Nilai</th>	
		<th field="pk_a" sortable="false" halign="center" align="center" width="50px">Index</th>		
		<th field="pk_a_nilai" sortable="false" halign="center" align="center"  width="60px">Nilai</th>			
		<th field="pk_b" sortable="false" halign="center" align="center" width="50px">Index</th>		
		<th field="pk_b_nilai" sortable="false" halign="center" align="center"  width="60px">Nilai</th>			
	  </tr>
	  </thead>  
	</table>
	
	<!-- Area untuk Form Add/Edit >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
	
	<div id="dlg<?=$objectId;?>" class="easyui-dialog" style="width:720px;height:350px;padding:10px 20px" closed="true"  buttons="#dlg-buttons">
		<!----------------Edit title-->
		
		<form id="fm<?=$objectId;?>" method="post" >			
			
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Tahun :</label>
				<span id="spanTahun<?=$objectId?>"></span>
				<input type="hidden" id="tahun<?=$objectId?>" name="tahun">
				<input type="hidden" id="kke2b_e1_id<?=$objectId?>" name="kke2b_e1_id"/>				
			</div>
			<div class="fitem" >
				<label style="width:130px">Unit Kerja Eselon I :</label>
					<input type="hidden" name="kode_e1" id="kode_e1<?=$objectId?>" value="<? echo FILTER_E1?>"/>
						<?php 
							//$data['value'] = FILTER_E1;
							echo $this->eselon1_model->getNamaE1(FILTER_E1);
						?>
			</div>	
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Sasaran Eselon I :</label>					
					<span id="spanSasaran<?=$objectId?>"></span>
					<input type="hidden" id="kode_sasaran_e1<?=$objectId?>" name="kode_sasaran_e1">
			</div>
			
			<div class="fitem">
				
				<hr>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Unit Kerja A :</label> <br>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Renstra IP :</label>
				 <?=$renstra_a_radio?>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">RKT IP :</label>
				 <?=$rkt_a_radio?>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">PK IP :</label>
				 <?=$pk_a_radio?>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Unit Kerja B :</label><br>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Renstra IP :</label>
				 <?=$renstra_b_radio?>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">RKT IP :</label>
				 <?=$rkt_b_radio?>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">PK IP :</label>
				 <?=$pk_b_radio?>
			</div>
		</form>
		<div id="dlg-buttons">
			<!----------------Edit title-->
			<a href="#" id="saveBtn<?=$objectId;?>" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData<?=$objectId;?>()">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg<?=$objectId;?>').dialog('close')">Cancel</a>
		</div>
	</div>
	
