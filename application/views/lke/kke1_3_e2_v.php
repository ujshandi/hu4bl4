	<script  type="text/javascript" >
		$(function(){
			var url;
			
			clearFilter<?=$objectId;?> = function (){
				//ambil nilai-nilai filter
				$("#filter_tahun<?=$objectId;?>").val(''); 			
				$("#filter_e2<?=$objectId;?>").val('');			
				$("#filter_sasaran<?=$objectId;?>").val('');			
				$("#filter_iku<?=$objectId;?>").val('');			
				//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>lke/kke1_3_e2/grid/"+filtahun+"/"+filnama+"/"+filalamat});
					//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>lke/kke1_3_e2/grid/"+filtahun+"/"+filnama+"/"+filalamat});
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
						$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','Add KKE1-III Capaian');  
						$('#fm<?=$objectId;?>').form('clear');  						
						//initCombo<?=$objectId?>();
						url = base_url+'lke/kke1_3_e2/save';  
						$("#kke13_e2_id<?=$objectId?>").val(row.kke13_e2_id);
						$("#tahun<?=$objectId?>").val(row.tahun);						
						$("#spanTahun<?=$objectId?>").text(row.tahun);
						$("#kode_e2<?=$objectId?>").val(row.kode_e2);
						$("#spanE2<?=$objectId?>").text(row.nama_e2);
						$("#kode_sasaran_e2<?=$objectId?>").val(row.kode_sasaran_e2);
						$("#spanSasaran<?=$objectId?>").text(row.sasaran_strategis);
						$("#kode_ikk<?=$objectId?>").val(row.kode_ikk);
						$("#spanIku<?=$objectId?>").text(row.indikator_kinerja);
						
						<? $i=0;
						foreach($listIndex_catatan_keuangan->result() as $r){?>
							$('input:radio[name=catatan_keuangan]:nth(<?=$i?>)').prop('checked',(row.catatan_keuangan=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_masyarakat->result() as $r){?>
							$('input:radio[name=masyarakat]:nth(<?=$i?>)').prop('checked',(row.masyarakat=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_instansi_lainnya->result() as $r){?>
							$('input:radio[name=instansi_lainnya]:nth(<?=$i?>)').prop('checked',(row.instansi_lainnya=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_transparansi->result() as $r){?>
							$('input:radio[name=transparansi]:nth(<?=$i?>)').prop('checked',(row.transparansi=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_penghargaan->result() as $r){?>
							$('input:radio[name=penghargaan]:nth(<?=$i?>)').prop('checked',(row.penghargaan=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						/* $('input:radio[name=catatan_keuangan]:nth(0)').prop('checked',(row.catatan_keuangan=='A'));
						$('input:radio[name=catatan_keuangan]:nth(1)').prop('checked',(row.catatan_keuangan=='B'));
						$('input:radio[name=catatan_keuangan]:nth(2)').prop('checked',(row.catatan_keuangan=='C'));
						$('input:radio[name=catatan_keuangan]:nth(3)').prop('checked',(row.catatan_keuangan=='D'));
						$('input:radio[name=catatan_keuangan]:nth(4)').prop('checked',(row.catatan_keuangan=='E'));
						
						$('input:radio[name=masyarakat]:nth(0)').prop('checked',(row.masyarakat=='A'));
						$('input:radio[name=masyarakat]:nth(1)').prop('checked',(row.masyarakat=='B'));
						$('input:radio[name=masyarakat]:nth(2)').prop('checked',(row.masyarakat=='C'));
						$('input:radio[name=masyarakat]:nth(3)').prop('checked',(row.masyarakat=='D'));
						$('input:radio[name=masyarakat]:nth(4)').prop('checked',(row.masyarakat=='E'));
						
						$('input:radio[name=instansi_lainnya]:nth(0)').prop('checked',(row.instansi_lainnya=='A'));
						$('input:radio[name=instansi_lainnya]:nth(1)').prop('checked',(row.instansi_lainnya=='B'));
						$('input:radio[name=instansi_lainnya]:nth(2)').prop('checked',(row.instansi_lainnya=='C'));
						$('input:radio[name=instansi_lainnya]:nth(3)').prop('checked',(row.instansi_lainnya=='D'));
						$('input:radio[name=instansi_lainnya]:nth(4)').prop('checked',(row.instansi_lainnya=='E'));
						
						$('input:radio[name=transparansi]:nth(0)').prop('checked',(row.transparansi=='A'));
						$('input:radio[name=transparansi]:nth(1)').prop('checked',(row.transparansi=='B'));
						$('input:radio[name=transparansi]:nth(2)').prop('checked',(row.transparansi=='C'));
						$('input:radio[name=transparansi]:nth(3)').prop('checked',(row.transparansi=='D'));
						$('input:radio[name=transparansi]:nth(4)').prop('checked',(row.transparansi=='E'));
						
						$('input:radio[name=penghargaan]:nth(0)').prop('checked',(row.penghargaan=='A'));
						$('input:radio[name=penghargaan]:nth(1)').prop('checked',(row.penghargaan=='B'));
						$('input:radio[name=penghargaan]:nth(2)').prop('checked',(row.penghargaan=='C'));
						$('input:radio[name=penghargaan]:nth(3)').prop('checked',(row.penghargaan=='D'));
						$('input:radio[name=penghargaan]:nth(4)').prop('checked',(row.penghargaan=='E')); */
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
				<? if ($this->session->userdata('unit_kerja_e2')==-1){?>
					var file2 = $("#filter_e2<?=$objectId;?>").val();
				<?} else {?>
					var file2 = "<?=$this->session->userdata('unit_kerja_e2');?>";
				<?}?>
				
				 if(filtahun==null) filtahun ="-1";
				 if((file2==null)||(file2.length==0)) file2 ="-1";
				var filsasaran = "-1";
				var filiku = "-1";
				
				if (tipe==1){
					return "<?=base_url()?>lke/kke1_3_e2/grid/"+filtahun+"/"+file2;
				}
				else if (tipe==2){
					return "<?=base_url()?>lke/kke1_3_e2/pdf/"+filtahun+"/"+file2+"/"+filsasaran+"/"+filiku+paging;
				}else if (tipe==3){
					return "<?=base_url()?>lke/kke1_3_e2/excel/"+filtahun+"/"+file2+"/"+filsasaran+"/"+filiku+paging;
				}
				
			}
			
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
				alert("Fasilitas Pdf belum tersedia");
				//window.open(getUrl<?=$objectId;?>(2));;
				
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
						//alert(sasaran);
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
				url:"<?=base_url()?>lke/kke1_3_e2/grid",
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
		
		.datagrid-header .datagrid-cell{
			height:auto;
			line-height:auto;
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
				<?=$this->rkteselon2_model->getListFilterTahun($objectId,false)?>
				</td>			
			</tr>
			<tr>
					<td>Unit Kerja Eselon I :</td>
					<td>
					<?=$this->eselon1_model->getListFilterEselon1($objectId,$this->session->userdata('unit_kerja_e1'))?>
					</td>
				</tr>
				<tr>
					<td>Unit Kerja Eselon II :</td>
					<td><span class="fitem" id="divUnitKerja<?=$objectId;?>">
					<?=$this->eselon2_model->getListFilterEselon2($objectId,$this->session->userdata('unit_kerja_e1'),$this->session->userdata('unit_kerja_e2'),false)?>
					</span>
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
	  <? if($this->sys_menu_model->cekAkses('ADD;',317,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-ok" plain="true">Set Kinerja</a>  
		<?}?>
	
		
			<? if($this->sys_menu_model->cekAkses('PRINT;',317,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a 	href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('EXCEL;',317,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
			<?}?>
	  </div>
	</div>
	
	<table id="dg<?=$objectId;?>" class="easyui-datagrid" style="height:auto;width:auto" title="Laporan KKE1-III Capaian" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="false" pagination="true"  nowrap="false" showFooter="true">
	  <thead>
	  <tr>
		
		<th field="no" rowspan="4" sortable="false" width="25px">No.</th>
		<th field="kke13_e2_id" rowspan="4" sortable="false" hidden="true" width="25px">kke13_e2_id</th>
		<th field="tahun" rowspan="4" sortable="false" hidden="true" width="25px">tahun</th>
		<th field="kode_e2" rowspan="4" sortable="false" hidden="true" >kode_e2</th>
		<th field="nama_e2" rowspan="4" sortable="false" hidden="true" >nama_e2</th>
		<th field="kode_sasaran_e2" rowspan="4" sortable="false" hidden="true" width="25px">kode_sasaran_e2</th>
		<th field="kode_ikk" rowspan="4" sortable="false" hidden="true" width="25px"kode_ikk</th>
		<th field="sasaran_strategis" rowspan="4"  halign="center" sortable="false" width="250px">Sasaran Strategis</th>
		<th  sortable="false" rowspan="2" colspan="2"  halign="center" width="250px">Indikator Kinerja Utama</th>
		<th sortable="false" colspan="10" align="center" halign="center">Acuan Kinerja</th>
		
	  </tr>
	  <tr>
		
		<th sortable="false" halign="center" rowspan="1" colspan="2" width="130px">Pencatatan </th>
		<th sortable="false" halign="center" rowspan="2" colspan="2" width="130px" >Masyarakat/Publik</th>
		<th sortable="false" halign="center" rowspan="1" colspan="2" width="130px" >Instansi</th>
		<th sortable="false" halign="center" rowspan="2" colspan="2" width="130px" >Transparansi</th>
		<th sortable="false" halign="center" rowspan="2" colspan="2" width="130px" >Penghargaan Lainnya</th>	
	  </tr>
	  <tr>
		<th field="no_indikator" sortable="false" width="30px" rowspan="2">No.</th>
		<th field="indikator_kinerja" sortable="false" width="220px" rowspan="2">Deskripsi</th>
		<th sortable="false" halign="center" rowspan="1" colspan="2" width="130px">Keuangan & Integritas</th>
		<th sortable="false" halign="center" rowspan="1" colspan="2" width="130px"> Pemerintah Lainnya</th>
	  </tr>
	  <tr>		
		<th field="catatan_keuangan" sortable="false" halign="center" align="center" width="50px">Index</th>
		<th field="catatan_keuangan_nilai" sortable="false" halign="center" align="center" width="80px">Nilai</th>
		<th field="masyarakat" sortable="false" halign="center" align="center" width="50px">Index</th>
		<th field="masyarakat_nilai" sortable="false" halign="center" align="center" width="80px">Nilai</th>
		<th field="instansi_lainnya" sortable="false" halign="center" align="center" width="50px">Index</th>
		<th field="instansi_lainnya_nilai" sortable="false" halign="center" align="center" width="80px">Nilai</th>
		<th field="transparansi" sortable="false" halign="center" align="center" width="50px">Index</th>
		<th field="transparansi_nilai" sortable="false" halign="center" align="center" width="80px">Nilai</th>
		<th field="penghargaan" sortable="false" halign="center" align="center" width="50px">Index</th>
		<th field="penghargaan_nilai" sortable="false" halign="center" align="center" width="80px">Nilai</th>
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
				<input type="hidden" id="kke13_e2_id<?=$objectId?>" name="kke13_e2_id"/>				
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Unit Kerja Eselon II :</label>
				<span id="spanE2<?=$objectId?>"></span>
				<input type="hidden" id="kode_e2<?=$objectId?>" name="kode_e2">
				
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Sasaran Eselon II :</label>					
					<span id="spanSasaran<?=$objectId?>"></span>
					<input type="hidden" id="kode_sasaran_e2<?=$objectId?>" name="kode_sasaran_e2">
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">IKK :</label>
				<?//=$this->iku_kl_model->getListIKU_KL($objectId,"",false)?>
				<input type="hidden" id="kode_ikk<?=$objectId?>" name="kode_ikk">
				<span id="spanIku<?=$objectId?>">
				</span>
			</div>
			<div class="fitem">
				
				<hr>
			</div>
			<div class="fitem" style="height:20px;margin-bottom:20px">
				<label style="width:150px;vertical-align:top">Kinerja Pencatatan Keuangan & Integritas :</label>
				 <?=$catatan_keuangan_radio?>
			</div>
			<div class="fitem" style="height:20px;margin-bottom:20px">
				<label style="width:150px;vertical-align:top">Kinerja Dari Masyarakat Lainnya :</label>
				 <?=$masyarakat_radio?>
			</div>
			<div class="fitem" style="height:20px;margin-bottom:20px">
				<label style="width:150px;vertical-align:top">Kinerja Dari Instansi Pemerintah Lainnya :</label>
				 <?=$instansi_lainnya_radio?>
			</div>
			<div class="fitem" style="height:20px;margin-bottom:20px">
				<label style="width:150px;vertical-align:top">Kinerja Transparansi :</label>
				 <?=$transparansi_radio?>
			</div>
			<div class="fitem" style="height:20px;margin-bottom:20px">
				<label style="width:150px;vertical-align:top">Kinerja Penghargaan Lainnya :</label>
				 <?=$penghargaan_radio?>
			</div>
			
			
			
			
		</form>
		<div id="dlg-buttons">
			<!----------------Edit title-->
			<a href="#" id="saveBtn<?=$objectId;?>" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData<?=$objectId;?>()">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg<?=$objectId;?>').dialog('close')">Cancel</a>
		</div>
	</div>