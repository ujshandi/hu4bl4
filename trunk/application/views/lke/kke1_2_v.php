	<script  type="text/javascript" >
		$(function(){
			var url;
			
			clearFilter<?=$objectId;?> = function (){
				//ambil nilai-nilai filter
				$("#filter_tahun<?=$objectId;?>").val(''); 			
				$("#filter_e1<?=$objectId;?>").val('');			
				$("#filter_sasaran<?=$objectId;?>").val('');			
				$("#filter_iku<?=$objectId;?>").val('');			
				//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>lke/kke1_2/grid/"+filtahun+"/"+filnama+"/"+filalamat});
					//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>lke/kke1_2/grid/"+filtahun+"/"+filnama+"/"+filalamat});
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
					return "<?=base_url()?>lke/kke1_2/grid/"+filtahun+"/"+file1;
				}
				else if (tipe==2){
					return "<?=base_url()?>lke/kke1_2/pdf/"+filtahun+"/"+file1+"/"+filsasaran+"/"+filiku+paging;
				}else if (tipe==3){
					return "<?=base_url()?>lke/kke1_2/excel/"+filtahun+"/"+file1+"/"+filsasaran+"/"+filiku+paging;
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
						$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','Add KKE1-II Capaian');  
						$('#fm<?=$objectId;?>').form('clear');  						
						//initCombo<?=$objectId?>();
						url = base_url+'lke/kke1_2/save';  
						$("#kke12_e1_id<?=$objectId?>").val(row.kke12_e1_id);
						$("#tahun<?=$objectId?>").val(row.tahun);
						$("#spanTahun<?=$objectId?>").text(row.tahun);
						$("#kode_sasaran_e1<?=$objectId?>").val(row.kode_sasaran_e1);
						$("#spanSasaran<?=$objectId?>").text(row.sasaran_strategis);
						$("#kode_iku_e1<?=$objectId?>").val(row.kode_iku_e1);
						$("#spanIku<?=$objectId?>").text(row.indikator_kinerja);
						
						$('input:radio[name=sasaran_tepat]:nth(0)').prop('checked',(row.sasaran_tepat=='A'));
						$('input:radio[name=sasaran_tepat]:nth(1)').prop('checked',(row.sasaran_tepat=='B'));
						$('input:radio[name=sasaran_tepat]:nth(2)').prop('checked',(row.sasaran_tepat=='C'));
						$('input:radio[name=sasaran_tepat]:nth(3)').prop('checked',(row.sasaran_tepat=='D'));
						$('input:radio[name=sasaran_tepat]:nth(4)').prop('checked',(row.sasaran_tepat=='E'));
						
						$('input:radio[name=ik_tepat]:nth(0)').prop('checked',(row.ik_tepat=='A'));
						$('input:radio[name=ik_tepat]:nth(1)').prop('checked',(row.ik_tepat=='B'));
						$('input:radio[name=ik_tepat]:nth(2)').prop('checked',(row.ik_tepat=='C'));
						$('input:radio[name=ik_tepat]:nth(3)').prop('checked',(row.ik_tepat=='D'));
						$('input:radio[name=ik_tepat]:nth(4)').prop('checked',(row.ik_tepat=='E'));
						
						$('input:radio[name=target_tercapai]:nth(0)').prop('checked',(row.target_tercapai=='A'));
						$('input:radio[name=target_tercapai]:nth(1)').prop('checked',(row.target_tercapai=='B'));
						$('input:radio[name=target_tercapai]:nth(2)').prop('checked',(row.target_tercapai=='C'));
						$('input:radio[name=target_tercapai]:nth(3)').prop('checked',(row.target_tercapai=='D'));
						$('input:radio[name=target_tercapai]:nth(4)').prop('checked',(row.target_tercapai=='E'));
						
						$('input:radio[name=kinerja_baik]:nth(0)').prop('checked',(row.kinerja_baik=='A'));
						$('input:radio[name=kinerja_baik]:nth(1)').prop('checked',(row.kinerja_baik=='B'));
						$('input:radio[name=kinerja_baik]:nth(2)').prop('checked',(row.kinerja_baik=='C'));
						$('input:radio[name=kinerja_baik]:nth(3)').prop('checked',(row.kinerja_baik=='D'));
						$('input:radio[name=kinerja_baik]:nth(4)').prop('checked',(row.kinerja_baik=='E'));
						
						$('input:radio[name=data_andal]:nth(0)').prop('checked',(row.data_andal=='A'));
						$('input:radio[name=data_andal]:nth(1)').prop('checked',(row.data_andal=='B'));
						$('input:radio[name=data_andal]:nth(2)').prop('checked',(row.data_andal=='C'));
						$('input:radio[name=data_andal]:nth(3)').prop('checked',(row.data_andal=='D'));
						$('input:radio[name=data_andal]:nth(4)').prop('checked',(row.data_andal=='E'));
					}
						
					else {
						alert('Data IKU belum dipilih!');
					}
				/* }	
				else {
					alert("Pilih data subkomponen terlebih dahulu");
				} */
				//addTab("Add PK Kementerian", "lke/kke1_2/add");
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
						$('#dg<?=$objectId;?>').datagrid('mergeCells',{
							index:merges[i][0],
							field:'target_tercapai_persen',
							rowspan:merges[i][1]
						}); 
						$('#dg<?=$objectId;?>').datagrid('mergeCells',{
							index:merges[i][0],
							field:'kinerja_baik_persen',
							rowspan:merges[i][1]
						}); 
						$('#dg<?=$objectId;?>').datagrid('mergeCells',{
							index:merges[i][0],
							field:'data_andal_persen',
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
				url:"<?=base_url()?>lke/kke1_2/grid",
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
				<?=$this->iku_e1_model->getListTahun($objectId,"filter_tahun","false",false);?>
				</td>
				<td width="10px">&nbsp;</td>
				<td><a href="#" class="easyui-linkbutton" onclick="searchData<?=$objectId;?>();" iconCls="icon-search">Search</a>
				</td>
			</tr>
			</table>
		  </div>
		</td>
	  </tr>
	  </table>
	  <div style="margin-bottom:5px">  
	  <? if($this->sys_menu_model->cekAkses('ADD;',302,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-ok" plain="true">Set Kinerja</a>  
		<?}?>
	
		
		
			<? if($this->sys_menu_model->cekAkses('PRINT;',253,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a 	href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('EXCEL;',253,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
			<?}?>
	  </div>
	</div>
	
	<table id="dg<?=$objectId;?>" style="height:auto;width:auto" title="Laporan KKE1-II Capaian" toolbar="#tb<?=$objectId;?>" fitColumns="false" singleSelect="true" rownumbers="false" pagination="true"  nowrap="false" showFooter="true">
	  <thead>
	  <tr>
		
		<th field="no" rowspan="3" sortable="false" width="25px">No.</th>
		<th field="kke12_e1_id" rowspan="3" sortable="false" hidden="true">kke12_e1_id</th>
		<th field="tahun" rowspan="3" sortable="false" hidden="true" >tahun</th>
		<th field="kode_sasaran_e1" rowspan="3" sortable="false" hidden="true" >kode_sasaran_e1</th>
		<th field="kode_iku_e1" rowspan="3" sortable="false" hidden="true">kode_iku_e1</th>
		<th field="sasaran_strategis"  rowspan="3"  sortable="false" width="250px">Sasaran Strategis</th>
		<th  sortable="false" colspan="2" width="250px">Indikator Kinerja Utama</th>
		
		<th colspan="13" sortable="false" align="center" >Outcome IP</th>
		
	  </tr>
	  <tr>		
		<th field="no_indikator" sortable="false" width="30px" rowspan="2">No.</th>
		<th field="indikator_kinerja" sortable="false" width="220px" rowspan="2">Deskripsi</th>
		<th sortable="false"colspan="2">Sasaran Tepat</th>
		<th sortable="false"colspan="2">IK Tepat</th>
		<th sortable="false"colspan="3">Target Tercapai</th>
		<th sortable="false" colspan="3">Kinerja Lebih Baik</th>
		<th sortable="false" colspan="3">Data Andal</th>
		
	  </tr>
	  <tr>		
		<th field="sasaran_tepat" align="center" sortable="false" width="50px">Index</th>
		<th field="sasaran_tepat_nilai" align="center" halign="right" sortable="false" width="60px">Konversi</th>		
		<th field="ik_tepat" align="center" sortable="false" width="50px">Index</th>
		<th field="ik_tepat_nilai" align="center" halign="right" sortable="false" width="60px">Konversi</th>		
		<th field="target_tercapai" align="center" sortable="false" width="50px">Index</th>
		<th field="target_tercapai_nilai" halign="right" align="center" sortable="false" width="60px">Konversi</th>		
		<th field="target_tercapai_persen" align="center" halign="right" sortable="false" width="60px">Nilai(%)</th>	
		<th field="kinerja_baik" align="center" sortable="false" width="50px">Index</th>
		<th field="kinerja_baik_nilai" halign="right" align="center" sortable="false" width="60px">Konversi</th>		
		<th field="kinerja_baik_persen" align="center" halign="right" sortable="false" width="60px">Nilai(%)</th>		
		<th field="data_andal" align="center" sortable="false" width="50px">Index</th>
		<th field="data_andal_nilai" align="center" halign="right" sortable="false" width="60px">Konversi</th>		
		<th field="data_andal_persen" align="center" halign="right" sortable="false" width="60px">Nilai(%)</th>		
		
	  </tr>
	  </thead>  
	</table>
	
	<!-- Area untuk Form Add/Edit >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
	
	<div id="dlg<?=$objectId;?>" class="easyui-dialog" style="width:720px;height:400px;padding:10px 20px" closed="true"  buttons="#dlg-buttons">
		<!----------------Edit title-->
		
		<form id="fm<?=$objectId;?>" method="post" >			
			
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Tahun :</label>
				<span id="spanTahun<?=$objectId?>"></span>
				<input type="hidden" id="tahun<?=$objectId?>" name="tahun">
				<input type="hidden" id="kke12_e1_id<?=$objectId?>" name="kke12_e1_id"/>				
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Sasaran Eselon I :</label>					
					<span id="spanSasaran<?=$objectId?>"></span>
					<input type="hidden" id="kode_sasaran_e1<?=$objectId?>" name="kode_sasaran_e1">
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">IKU Eselon I :</label>
				<?//=$this->iku_kl_model->getListIKU_KL($objectId,"",false)?>
				<input type="hidden" id="kode_iku_e1<?=$objectId?>" name="kode_iku_e1">
				<span id="spanIku<?=$objectId?>">
				</span>
			</div>
			<div class="fitem">
				
				<hr>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Sasaran Tepat :</label>
				 <?=$sasarantepat_radio?>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">IK Tepat :</label>
				 <?=$iktepat_radio?>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Target Tercapai :</label>
				 <?=$targettercapai_radio?>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Kinerja Lebih Baik :</label>
				 <?=$kinerjabaik_radio?>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Data Andal :</label>
				 <?=$dataandal_radio?>
			</div>
			
			
			
			
		</form>
		<div id="dlg-buttons">
			<!----------------Edit title-->
			<a href="#" id="saveBtn<?=$objectId;?>" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData<?=$objectId;?>()">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg<?=$objectId;?>').dialog('close')">Cancel</a>
		</div>
	</div>