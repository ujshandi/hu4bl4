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
			
			
			function initCombo<?=$objectId?>(){
				// setListE2<?=$objectId?>();
				 setSasaranE1<?=$objectId;?>($("#tahun<?=$objectId?>").val(),"","");
				 setIKU<?=$objectId;?>($("#tahun<?=$objectId?>").val(),$("#kode_e1<?=$objectId?>").val());
			 }
			 
			 function setIKU<?=$objectId;?>(tahun,key,val){
				if ((tahun==null)||(tahun=="")) tahun = "-1";
				$("#divIKUKL<?=$objectId?>").load(
					base_url+"pengaturan/iku_e1/getListIKU_KL/"+"<?=$objectId;?>"+"/"+tahun,
					//on complete
					function(){
						$("textarea").autogrow();
						if($("#drop<?=$objectId;?>").is(":visible")){
							$("#drop<?=$objectId;?>").slideUp("slow");
						}
						
						$("#txtkode_iku_kl<?=$objectId;?>").click(function(){
							$("#drop<?=$objectId;?>").slideDown("slow");
						});
						
						$("#drop<?=$objectId;?> li").click(function(e){
							var chose = $(this).text();
							$("#txtkode_iku_kl<?=$objectId;?>").val(chose);
							$("#drop<?=$objectId;?>").slideUp("slow");
						});
						
						if (key!=null)
							$('#kode_iku_kl<?=$objectId;?>').val(key);
						if (val!=null)
							$('#txtkode_iku_kl<?=$objectId;?>').val(val);
					}
				);
			}  
			 
			var url;
			newData<?=$objectId;?> = function (){  
				/* var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
				if (row){
					if (row.has_child) {
						alert("Pilih data subkomponen terlebih dahulu");
						return false;
					} */
					$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','Add KKE1-II Capaian');  
					$('#fm<?=$objectId;?>').form('clear');  
					initCombo<?=$objectId?>();
					url = base_url+'lke/kke1_2/save';  
					
				
				
				
					$("#kke1_2_id<?=$objectId?>").val("");
					
					
				/* }	
				else {
					alert("Pilih data subkomponen terlebih dahulu");
				} */
				//addTab("Add PK Kementerian", "lke/kke1_2/add");
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
				window.open(getUrl<?=$objectId;?>(2));;
				//alert("Fasilitas Pdf belum tersedia");
			}
			toExcel<?=$objectId;?>=function(){
				//alert("Fasilitas Excel belum tersedia");
				window.open(getUrl<?=$objectId;?>(3));;
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
			
			$("#tahun<?=$objectId;?>").change(function(){
				//alert($(this).val());
				setSasaranE1<?=$objectId;?>($(this).val(),$("#kode_e1<?=$objectId?>").val(),'','')
				 setIKU<?=$objectId;?>($(this).val(),"","");
				  //setKodeOtomatis<?=$objectId?>();
			});

			function setSasaranE1<?=$objectId;?>(tahun,e1,key,val){
				<? if ($this->session->userdata('unit_kerja_e1')!='-1') {?>
				 e1 = '<?=$this->session->userdata('unit_kerja_e1');?>';
				 $("#kode_e1<?=$objectId;?>").val(e1);
				<?}?>
				if (tahun=="") tahun = "-1";
				 $("#divSasaran<?=$objectId?>").load(
					base_url+"pengaturan/sasaran_eselon2/getListSasaranE1/ListSasaran"+"<?=$objectId;?>"+"/"+e1+"/"+tahun,
					function(){
						$("textarea").autogrow();
						
						$("#txtkode_sasaran_e1ListSasaran<?=$objectId;?>").click(function(){
							$("#dropListSasaran<?=$objectId;?>").slideDown("slow");
						});
						
						$("#dropListSasaran<?=$objectId;?> li").click(function(e){
							var chose = $(this).text();
							$("#txtkode_sasaran_e1ListSasaran<?=$objectId;?>").val(chose);
							$("#dropListSasaran<?=$objectId;?>").slideUp("slow");
						});
						
						if (key!=null)
							$('#kode_sasaran_e1ListSasaran<?=$objectId;?>').val(key);
						if (val!=null)
							$('#txtkode_sasaran_e1ListSasaran<?=$objectId;?>').val(val);
					}
				); 
				//alert("here");
				
			}//end sasaran
			
			
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
			</tr>
			
			<tr>
		<!--		<td>Eselon 1 :</td>
				<td>
					<?='';//$this->eselon1_model->getListFilterEselon1($objectId,$this->session->userdata('unit_kerja_e1'))?>
				</td>
			</tr>
			<tr>
				<td>Kode Sasaran E1:</td>
				<td><input class="easyui-textbox" id="filter_sasaran<?=$objectId;?>"></td>
			</tr>
			<tr>
				<td>Kode IKU :</td>
				<td><input class="easyui-textbox" id="filter_iku<?=$objectId;?>"></td>
			</tr>-->
			<tr style="height:10px">
			  <td style="">
			  </td>
			</tr>
			<tr>			  
			  <td colspan="2" align="right">
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
	  <? if($this->sys_menu_model->cekAkses('ADD;',302,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>  
		<?}?>
	
		<!------------Edit View-->
		<? if($this->sys_menu_model->cekAkses('EDIT;',302,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>(true);" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Edit</a>
		<?}?>
		<? if($this->sys_menu_model->cekAkses('VIEW;',302,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>(false);" class="easyui-linkbutton" iconCls="icon-view" plain="true">View</a>
		<?}?>
		<? if($this->sys_menu_model->cekAkses('DELETE;',302,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="deleteData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-remove" plain="true">Delete</a>
		<?}?>
			<? if($this->sys_menu_model->cekAkses('PRINT;',253,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a 	href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('EXCEL;',253,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
			<?}?>
	  </div>
	</div>
	
	<table id="dg<?=$objectId;?>" class="easyui-datagrid" style="height:auto;width:auto" title="Laporan KKE1-II Capaian" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="false" pagination="true"  nowrap="false">
	  <thead>
	  <tr>
		
		<th field="no" rowspan="3" sortable="false" width="25px">No.</th>
		<th field="sasaran_strategis"  rowspan="3"  sortable="false" width="250px">Sasaran Strategis</th>
		<th  sortable="false" colspan="2" width="250px">Indikator Kinerja Utama</th>
		
		<th colspan="9" sortable="false" align="center" >Outcome IP</th>
		
	  </tr>
	  <tr>		
		<th field="no_indikator" sortable="false" width="30px" rowspan="2">No.</th>
		<th field="indikator_kinerja" sortable="false" width="220px" rowspan="2">Deskripsi</th>
		<th sortable="false"colspan="3">Target Tercapai</th>
		<th sortable="false" colspan="3">Kinerja Lebih Baik</th>
		<th sortable="false" colspan="3">Data Andal</th>
		
	  </tr>
	  <tr>		
		
		<th field="target_tercapai" sortable="false" width="50px">Index</th>
		<th field="konversi" sortable="false" width="80px">Konversi</th>		
		<th field="nilai" sortable="false" width="100px">Nilai(%)</th>	
		<th field="kinerja_baik" sortable="false" width="50px">Index</th>
		<th field="konversi" sortable="false" width="80px">Konversi</th>		
		<th field="nilai" sortable="false" width="100px">Nilai(%)</th>		
		<th field="data_andal" sortable="false" width="50px">Index</th>
		<th field="konversi" sortable="false" width="80px">Konversi</th>		
		<th field="nilai" sortable="false" width="100px">Nilai(%)</th>		
		
	  </tr>
	  </thead>  
	</table>
	
	<!-- Area untuk Form Add/Edit >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
	
	<div id="dlg<?=$objectId;?>" class="easyui-dialog" style="width:720px;height:400px;padding:10px 20px" closed="true"  buttons="#dlg-buttons">
		<!----------------Edit title-->
		
		<form id="fm<?=$objectId;?>" method="post" >			
			
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Tahun :</label>
				<?=$this->iku_e1_model->getListTahun($objectId,"tahun","true",false);?>
				<input type="hidden" id="kke1_2_id<?=$objectId?>" name="kke1_2_id"/>				
			</div>
			<div class="fitem">
				<label style="width:120px">Sasaran Eselon I :</label>					
					<span id="divSasaran<?=$objectId?>">
				</span>
			</div>
			<div class="fitem">
				<label style="width:120px;vertical-align:top">IKU Eselon I :</label>
				<?//=$this->iku_kl_model->getListIKU_KL($objectId,"",false)?>
				<span id="divIKU<?=$objectId?>">
				</span>
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